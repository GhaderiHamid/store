<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    
    

    
    public function addAjax(\Illuminate\Http\Request $request)
    {
        $productId = $request->input('product_id');
        $cart = session()->get('cart', []);
        $cart[$productId] = ($cart[$productId] ?? 0) + 1;
        session(['cart' => $cart]);
        $cartCount = array_sum($cart);
        return response()->json(['success' => true, 'cart_count' => $cartCount]);
    }

    public function all()
    {
        return view('frontend.cart.all');
    }
    public function updateQuantity(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = max(1, intval($request->input('quantity')));
        $cart = session()->get('cart', []);
        $cart[$productId] = $quantity;
        session(['cart' => $cart]);

        // محاسبه جمع کل جدید
        $products = \App\Models\Product::whereIn('id', array_keys($cart))->get();
        $total = 0;
        foreach ($products as $item) {
            $qty = is_array($cart[$item->id]) ? ($cart[$item->id]['quantity'] ?? 1) : $cart[$item->id];
            $total += $item->price * intval($qty);
        }

        return response()->json([
            'success' => true,
            'total' => $total,
            'total_formatted' => number_format($total) . ' تومان'
        ]);
    }
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }
        return redirect()->route('frontend.cart.all');
    }
}
