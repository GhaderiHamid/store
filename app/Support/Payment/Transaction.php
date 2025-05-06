<?php

namespace App\Support\Payment;

use App\Models\Order;
use App\Models\Payment;
use App\Support\Basket\Basket;
use App\Support\Payment\Gateways\GatewayInterface;
use App\Support\Payment\Gateways\Pasargad;
use App\Support\Payment\Gateways\Saman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Transaction
{
    private $request;
    private $basket;

    public function __construct(Request $request, Basket $basket)
    {
        $this->request = $request;
        $this->basket = $basket;
    }

    public function checkout()
    {
        DB::beginTransaction();
        $t=1;
        try{
            $order = $this->makeOrder();
           
            $payment = $this->makePayment($order);
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return null;
        }

        // dd($this->getwayFactory());
        if($t==1)
        {
        return $this->getwayFactory()->pay($order);
        }
        $order = Order::create([
            'status_id' => 1
        ]);
        $this->normalizeQuantity($order);
        $this->basket->clear();
        return $order;
       
    }
    private function makeOrder()
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_number' => (Str::random(16))

        ]);

        
        $order->products()->attach($this->products());
        return $order;
    }

    private function makePayment($order)
    {
        return Payment::create([
            'order_id' => $order->id,
            
            
        ]);
    }
     
    private function products()
    {
        foreach ($this->basket->all() as $product) {
            $products[$product->id] = [
               
                'quantity' => $product->quantity,
                'discount'=>$product->discount,
                'price' => $product->price, // Assuming the Product model has a price attribute
                
            ];
        }
        return $products;
    }

    private function getwayFactory()
    {
        // $gateway=[
        //     'saman'=>Saman::class,
        //     'pasargad'=>Pasargad::class][$this->request->gateway];


        // return resolve($gateway);
        return resolve(Saman::class);
    }
    public function verify()
    {
        $result=$this->getwayFactory()->verify($this->request);
        if($result['status']==GatewayInterface::TRANSACTION_FAILED)
        {
            return false;
        }
        $this->confirmPayment($result);
        $this->normalizeQuantity($result['order']);
        $this->basket->clear();
        return true;
    }
    private function confirmPayment($result)
    {
       return $result['order']->payment->confirm($result['refNum'], $result['gateway']);
    }
    private function normalizeQuantity($order)
    {
       foreach($order->products as $product)
       {
        $product->decrementQuantity($product->pivot->quantity);
       }
    //    dd('test');
    }
}
