<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeUserController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('discount', '!=', 0)->get(); // محصولات دارای تخفیف
        return view('frontend.home.all', compact('categories', 'products'));
    }
        
    
   
   
}
