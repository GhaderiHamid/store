<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->with(['details.product', 'status_order'])->get();
        return view('frontend.order.all', compact('orders'));
    }
    
}
