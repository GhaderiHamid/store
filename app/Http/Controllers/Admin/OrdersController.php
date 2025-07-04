<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shipper;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function all(Request $request)
    {
        $statusLabels = [
            'processing' => 'در حال پردازش',
            'shipped' => 'در حال ارسال',
            'delivered' => 'تحویل داده شده',
            'return_requested' => 'درخواست بازگشت',
            'return_in_progress' => 'درحال بازگشت',
            'returned' => 'مرجوع شده',
            'return_rejected' => 'رد درخواست مرجوعی'
        ];

        // دریافت مقدار فیلتر از درخواست
        $query = Order::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // مرتب‌سازی بر اساس تاریخ (جدیدترین سفارشات ابتدا)
        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.orders.all', compact('orders', 'statusLabels'));
    }

    // نمایش جزئیات سفارش
    public function show(Order $order)
    {
        // dd($order);
        $statusLabels = [
            'processing' => 'در حال پردازش',
            'shipped' => 'در حال ارسال',
            'delivered' => 'تحویل داده شده',
            'return_requested' => 'درخواست بازگشت',
            'return_in_progress' => 'درحال بازگشت',
            'returned' => 'مرجوع شده',
            'return_rejected' => 'رد درخواست مرجوعی'
        ];
        // بارگیری روابط مورد نیاز
        // $order->load(['user', 'payment']);

        return view('admin.orders.show', compact('order', 'statusLabels'));
    }

    // فرم ویرایش سفارش
    public function edit(Order $order)
    {
        $statusLabels = [
            'processing' => 'در حال پردازش',
            'shipped' => 'در حال ارسال',
            'delivered' => 'تحویل داده شده',
            'return_requested' => 'درخواست بازگشت',
            'return_in_progress' => 'درحال بازگشت',
            'returned' => 'مرجوع شده',
            'return_rejected' => 'رد درخواست مرجوعی'
        ];
        $shippers = Shipper::all(); // ⬅ گرفتن لیست Shipperها

        return view('admin.orders.edit', compact('order', 'statusLabels', 'shippers'));
    }

    // بروزرسانی سفارش
    public function update(Request $request, Order $order)
    {
        $id = $order->id;
        $oldSend_shipper = $order->send_shipper;
        $oldReceive_shipper = $order->receive_shipper;

        if ($order->status === 'processing') {
            $validated = $request->validate([
                'send_shipper' => 'required|exists:shippers,id',
            ]);

            $order->update([
                'send_shipper' => $validated['send_shipper'],
                'status' => 'shipped',
            ]);

            foreach ($order->order_detail as $item) {
                $item->update(['status' => 'shipped']);
            }

            if ($oldSend_shipper !== $validated['send_shipper']) {
                if ($oldSend_shipper) {
                    Shipper::where('id', $oldSend_shipper)
                        ->where('send_orders', '>', 0)
                        ->decrement('send_orders');
                }
                Shipper::where('id', $validated['send_shipper'])->increment('send_orders');
            }
        } elseif ($order->status === 'return_requested') {
            $validated = $request->validate([
                'return_approval' => 'required|in:yes,no',
                'receive_shipper' => 'required_if:return_approval,yes|nullable|exists:shippers,id',
            ]);

            if ($validated['return_approval'] == 'yes') {
                $order->update([
                    'receive_shipper' => $validated['receive_shipper'],
                    'status' => 'return_in_progress',
                ]);

                foreach ($order->order_detail as $item) {
                    if ($item->order_id == $id && $item->return_quantity != null) {
                        $item->update(['status' => 'return_in_progress']);
                    }
                }

                if ($oldReceive_shipper !== $validated['receive_shipper']) {
                    if ($oldReceive_shipper) {
                        Shipper::where('id', $oldReceive_shipper)
                            ->where('receive_orders', '>', 0)
                            ->decrement('receive_orders');
                    }
                    Shipper::where('id', $validated['receive_shipper'])->increment('receive_orders');
                }
            } elseif ($validated['return_approval'] == 'no') {
                $order->update([
                    'receive_shipper' => null,
                    'status' => 'return_rejected',
                ]);

                foreach ($order->order_detail as $item) {
                    if ($item->order_id == $id && $item->return_quantity != null) {
                        $item->update(['status' => 'return_rejected']);
                    }
                }

                // اگر قبلا مامور بازگشت داشت، شمارنده را کاهش دهید
                if ($oldReceive_shipper) {
                    Shipper::where('id', $oldReceive_shipper)
                        ->where('receive_orders', '>', 0)
                        ->decrement('receive_orders');
                }
            }
        } elseif ($order->status === 'shipped') {
            $validated = $request->validate([
                'send_shipper' => 'required|exists:shippers,id',
            ]);

            $order->update(['send_shipper' => $validated['send_shipper']]);

            if ($oldSend_shipper !== $validated['send_shipper']) {
                if ($oldSend_shipper) {
                    Shipper::where('id', $oldSend_shipper)
                        ->where('send_orders', '>', 0)
                        ->decrement('send_orders');
                }
                Shipper::where('id', $validated['send_shipper'])->increment('send_orders');
            }
        } elseif ($order->status === 'return_in_progress') {
            $validated = $request->validate([
                'receive_shipper' => 'required|exists:shippers,id',
            ]);

            $order->update(['receive_shipper' => $validated['receive_shipper']]);

            if ($oldReceive_shipper !== $validated['receive_shipper']) {
                if ($oldReceive_shipper) {
                    Shipper::where('id', $oldReceive_shipper)
                        ->where('receive_orders', '>', 0)
                        ->decrement('receive_orders');
                }
                Shipper::where('id', $validated['receive_shipper'])->increment('receive_orders');
            }
        }

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'سفارش با موفقیت به‌روزرسانی شد.');
    }
}
