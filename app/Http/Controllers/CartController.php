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

        // محاسبه جمع کل پس از تغییر تعداد
        $total = array_sum(array_map(function ($item) {
            return is_array($item) ? $item['quantity'] * ($item['price'] * (1 - ($item['discount'] ?? 0) / 100)) : $item;
        }, $cart));

        return response()->json([
            'success' => true,
            'updated_quantity' => is_array($cart[$productId]) ? $cart[$productId]['quantity'] : $cart[$productId],
            'total' => $total,
            'formatted_total' => number_format($total) . ' تومان'
        ]);
    }

    return response()->json(['success' => false]);
}


    // ...existing methods...
}