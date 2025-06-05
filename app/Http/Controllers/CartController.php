<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // ...existing methods...

    public function updateQuantity(Request $request)
    {
        $cart = session('cart', []);
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        if (isset($cart[$productId])) {
            if (is_array($cart[$productId])) {
                $cart[$productId]['quantity'] = $quantity;
            } else {
                $cart[$productId] = $quantity;
            }
            session(['cart' => $cart]);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    // ...existing methods...
}