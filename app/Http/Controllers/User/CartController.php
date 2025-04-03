<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public $minutes = 60;
    public function add($product_id)
    {


        //    Cookie::queue('test', 'product',1);
        $product = Product::findOrFail($product_id);
        $cart = json_decode(Cookie::get('cart'), true);
        
        if (!$cart) {
            $cart = [
                $product->id => [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image_path' => $product->image_path,
                ],
            ];
            $cart = json_encode($cart);
            Cookie::queue('cart', $cart, $this->minutes);
            return back()->with('success', 'محصول به سبد خرید اضافه شد');
        }
        //    if(isset($cart[$product->id]))
        //    {
        //         return back()->with('success', 'محصول به سبد خرید اضافه شد');
        //     }
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'image_path' => $product->image_path,
        ];
        Cookie::queue('cart', json_encode($cart), $this->minutes);
        return back()->with('success', 'محصول به سبد خرید اضافه شد');
    }
    public function all(){
        return view('frontend.cart.all');
    }
    public function remove($product_id)
    {
        $cart = json_decode(Cookie::get('cart'), true);
        if(isset($cart[$product_id]))
        {
            unset($cart[$product_id]);

        }
        Cookie::queue('cart',json_encode($cart), $this->minutes);

        return back()->with('success','محصول از سبد خرید حذف شد');
    }
}
