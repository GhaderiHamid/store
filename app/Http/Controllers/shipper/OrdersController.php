<?php

namespace App\Http\Controllers\shipper;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index()
    {
        $status = request('status', 'shipped');

        // تعداد سفارشات برای هر وضعیت
        $counts = [
            'shipped' => Order::where(function ($query) {
                $query->where('send_shipper', auth('shipper')->id())
                    ->orWhere('receive_shipper', auth('shipper')->id());
            })
                ->where('status', 'shipped')
                ->count(),

            'return_in_progress' => Order::where(function ($query) {
                $query->where('send_shipper', auth('shipper')->id())
                    ->orWhere('receive_shipper', auth('shipper')->id());
            })
                ->where('status', 'return_in_progress')
                ->count(),
        ];

        // دریافت سفارشات با صفحه‌بندی
        $orders = Order::where(function ($query) {
            $query->where('send_shipper', auth('shipper')->id())
                ->orWhere('receive_shipper', auth('shipper')->id());
        })
            ->where('status', $status)
            ->with(['details.product', 'user'])
            ->orderBy('created_at', 'asc')
            ->paginate(9);

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

        return view('shipper.index', compact('orders', 'statusLabels', 'counts'));
    }
    public function deliver(Order $order)
    {
        // بررسی اینکه سفارش متعلق به این ارسال کننده است
        if ($order->send_shipper != auth('shipper')->id() && $order->receive_shipper != auth('shipper')->id()) {
            return response()->json(['success' => false, 'message' => 'دسترسی غیرمجاز'], 403);
        }

        // تغییر وضعیت سفارش
        $order->update(['status' => 'delivered']);
        if ($order->send_shipper) {
            Shipper::where('id', $order->send_shipper)
                ->decrement('send_orders');
        }
        $order->order_detail()->update(['status' => 'delivered']);
        return response()->json(['success' => true]);
    }
    public function markAsReturned(Order $order)
    {
        // بررسی اینکه سفارش متعلق به این ارسال کننده است
        if ($order->send_shipper != auth('shipper')->id() && $order->receive_shipper != auth('shipper')->id()) {
            return response()->json(['success' => false, 'message' => 'دسترسی غیرمجاز'], 403);
        }

        // تغییر وضعیت سفارش
        $order->update(['status' => 'returned']);
        if ($order->receive_shipper) {
            Shipper::where('id', $order->receive_shipper)
                ->decrement('receive_orders');
        }
        foreach ($order->order_detail as $item) {

            if ($item->order_id == $order->id && $item->return_quantity != null) {
                $item->update([
                    'status' => 'returned',
                ]);
            }
        }
        return response()->json(['success' => true]);
    }
}
