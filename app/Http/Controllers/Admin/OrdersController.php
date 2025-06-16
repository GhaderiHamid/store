<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function all(Request $request)
    {
        $statusLabels = [
            'processing' => 'در حال پردازش',
            'shipped' => 'ارسال شده',
            'delivered' => 'تحویل داده شده',
            'returned' => 'مرجوع شده'
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
        $statusLabels = [
            'processing' => 'در حال پردازش',
            'shipped' => 'ارسال شده',
            'delivered' => 'تحویل داده شده',
            'returned' => 'مرجوع شده'
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
            'shipped' => 'ارسال شده',
            'delivered' => 'تحویل داده شده',
            'returned' => 'مرجوع شده'
        ];

        return view('admin.orders.edit', compact('order', 'statusLabels'));
    }

    // بروزرسانی سفارش
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required',
            
          
        ]);

        $order->update($validated);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'سفارش با موفقیت به‌روزرسانی شد');
    }
   
}
