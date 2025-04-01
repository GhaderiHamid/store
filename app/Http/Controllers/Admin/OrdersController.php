<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function all()
    {
        $orders=Order::paginate(10);
        // در کنترلر مربوطه
        // $orders = Order::with(['user', 'status_order'])->get();
                return view('admin.orders.all',compact('orders'));
    }
   
}
