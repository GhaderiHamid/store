<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function showDiscountedProducts()
    {
        $products = Product::where('discount', '!=', 0)->get();
        return view('frontend.home.all', compact('products'));
    }
}
