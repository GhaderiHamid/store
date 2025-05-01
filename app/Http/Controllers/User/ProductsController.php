<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Vote;
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function all(Request $request)
    {
        dump(session()->all());
        $query = Product::query();

        // اعمال جستجو در صورت وجود
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }
        
        // اعمال مرتب‌سازی بر اساس پارامتر sort
       else if ($request->get('sort') === 'newest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->get('sort') === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->get('sort') === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->get('sort') === 'best_selling') {
            // فرض کنید فیلدی مانند sold برای تعداد فروش وجود دارد.
            $query->orderBy('sold', 'desc');
        }
       else if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }



        $products = $query->paginate(20)->appends($request->except('page'));

        return view('frontend.product.all', compact('products'));
    }


    public function single($product_id)
    {

        $product = Product::findOrFail($product_id);
        $similarProducts = Product::where('category_id', $product->category_id)->take(4)->get();
        return view('frontend.product.single', compact('product', 'similarProducts'));
    }
    
   
}
