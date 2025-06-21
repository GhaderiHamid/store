<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use GrahamCampbell\ResultType\Success;

class OrderController extends Controller
{
    public function index()
    {
        // دریافت وضعیت از پارامتر URL یا مقدار پیش‌فرض
        $status = request('status', 'processing');

        // دریافت سفارشات مربوط به کاربر با جزئیات محصولات و صفحه‌بندی
        $orders = Order::where('user_id', auth()->id())
            ->where('status', $status)
            ->with(['details.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(5); // تعداد آیتم‌ها در هر صفحه

        // تعداد سفارشات برای هر وضعیت
        $counts = [
            'processing' => Order::where('user_id', auth()->id())
                ->where('status', 'processing')
                ->count(),
            'shipped' => Order::where('user_id', auth()->id())
                ->where('status', 'shipped')
                ->count(),
            'delivered' => Order::where('user_id', auth()->id())
                ->where('status', 'delivered')
                ->count(),
            'returned' => Order::where('user_id', auth()->id())
                ->where('status', 'returned')
                ->count(),
        ];

        // تعریف مقادیر متنی برای وضعیت سفارشات
        $statusLabels = [
            'processing' => 'در حال پردازش',
            'shipped' => 'در حال ارسال',
            'delivered' => 'تحویل داده شده',
            'return_requested' => 'درخواست بازگشت',
            'return_in_progress' => 'درحال بازگشت',
            'returned' => 'مرجوع شده',
            'return_rejected' => 'رد درخواست مرجوعی'
        ];

        // ارسال داده‌ها به ویو
        return view('frontend.order.all', compact('orders', 'statusLabels', 'counts'));
    }
    // نمایش فرم درخواست مرجوعی
    public function showForm(Order $order)
    {
        if ($order->status !== 'delivered' && $order->status !== 'return_requested') {
            abort(403, 'این سفارش هنوز تحویل نشده و نمی‌توان مرجوع کرد.');
        }

        return view('frontend.order.return_request', compact('order'));
    }


    public function submit(Request $request, Order $order)
    {
        $request->validate([
            'items' => 'required|array',
            'reason' => 'required|string|max:1000',
        ]);

        $items = $request->input('items');
        $reason = $request->input('reason');
        $changedCount = 0;

        foreach ($items as $id => $data) {
            $qty = (int) ($data['return_quantity'] ?? 0);
            $detail = $order->order_detail()->find($id);

            if ($detail && $qty > 0 && $qty <= $detail->quantity && $detail->status === 'delivered') {
                $detail->update([
                    'status' => 'return_requested',
                    'return_quantity' => $qty,
                    // 'return_note' => $reason,
                ]);
                $changedCount++;
            }
        }
     

        if ($changedCount > 0) {
            $order->update([
                // 'status' => $order->order_detail()->where('status', 'return_requested')->count() === $order->order_detail()->count()
                //     ? 'return_requested' : $order->status,
                'status' =>'return_requested',
                'return_full' => $order->order_detail()->where('status', 'return_requested')->count() === $order->order_detail()->count(),
                'return_note'=> $reason,
            ]);
            return  response()->json(['message' => 'درخواست مرجوعی ثبت شد.']);
           
        }

        return response()->json(['message' => 'هیچ مرجوعی ثبت نشد. لطفاً تعداد را درست وارد کنید.']);
    }
}
