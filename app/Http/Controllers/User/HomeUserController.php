<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order_detail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeUserController extends Controller
{
    
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('discount', '!=', 0)->get(); // محصولات دارای تخفیف
   
        
        $topProductIDs = Order_detail::select(
            'product_id',
            DB::raw('SUM(quantity) as total_quantity')
        )
            ->whereNotIn('status', ['returned', 'return_in_progress'])
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(20)
            ->pluck('product_id');

        
        $topProducts = Product::whereIn('id', $topProductIDs)->get();

     
        // dd($topProducts);
        return view('frontend.home.all', compact('categories', 'products', 'topProducts'));
    
    
    }
    public function about(){
        return view('frontend.home.about');
    }
    


    public function contact()
    {
        return view('frontend.home.contact');
    }
   
}
