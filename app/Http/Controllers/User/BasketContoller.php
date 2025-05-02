<?php

namespace App\Http\Controllers\User;

use App\Exceptions\QuantityExceededException;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Support\Basket\Basket;
use App\Support\Payment\Gateways\Pasargad;
use App\Support\Payment\Gateways\Saman;
use App\Support\Payment\Transaction;
use Illuminate\Http\Request;

class BasketContoller extends Controller
{
    private $basket;
    private $transaction;
     public function __construct(Basket $basket,Transaction $transaction)
     {
        $this->basket=$basket;
        $this->transaction=$transaction;
     }

     public function add(Product $product)
     {
        
       try{
            $this->basket->add($product, 1);

            return back()->with('success', 'محصول به سبد خرید اضافه شد');
       }
       catch(QuantityExceededException $e){
        return back()->with('error','محدودیت خرید');
       }
     }
     public function index()
     {
        $items=$this->basket->all();
        return view('frontend.cart.all',compact('items'));
     }
     public function checkout(Request $request)
     {
        // $this->validateForm($request);
         $this->transaction->checkout();
         
        return redirect()->route('frontend.home.all')->with('success','پرداخت با موفقیت انجام شد');
     }
    public function processPayment(Request $request)
    {
        $gatewayClass = [
            'saman' => Saman::class,
            'pasargad' => Pasargad::class
        ][$request->gateway] ?? null;

        if (!$gatewayClass) {
            return redirect()->back()->withErrors(['gateway' => 'درگاه انتخابی نامعتبر است.']);
        }

        $gateway = resolve($gatewayClass);
        return $gateway->processPayment($request->order_id);
    }
}
