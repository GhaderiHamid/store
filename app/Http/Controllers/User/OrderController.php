<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // دریافت سفارشات مربوط به کاربر با جزئیات محصولات
        $orders = Order::where('user_id', auth()->id())
            ->with(['details.product'])
            ->get();

        // تعریف مقادیر متنی برای وضعیت سفارشات
        $statusLabels = [
            'processing' => 'در حال پردازش',
            'shipped' => 'ارسال شده',
            'delivered' => 'تحویل داده شده',
            'returned' => 'مرجوع شده'
        ];

        // ارسال داده‌ها به ویو
        return view('frontend.order.all', compact('orders', 'statusLabels'));
    }
}
