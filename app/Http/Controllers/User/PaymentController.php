<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Support\Payment\Transaction;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
  
   public function process(Request $request)
   {
      $subtotal = $request->input('subtotal');
      return view('frontend.payment.all', compact('subtotal'));
   }
   public function pay(Request $request)
   {
      $amount = $request->amount;

      // ساخت شماره سفارش یکتا و غیرتکراری
      do {
         $orderId = 'ORD-' . time() . '-' . rand(1000,9999);
      } while (\App\Models\Payment::where('order_id', $orderId)->exists());

      // ذخیره سفارش در جدول orders با user_id
      $order = Order::create([
         'user_id' => Auth::id(),
         
         // سایر فیلدهای مورد نیاز جدول orders را اینجا اضافه کنید
      ]);

      // ذخیره جزییات سفارش در جدول order_details
      $cart = session()->get('cart', []);
      $products = Product::whereIn('id', array_keys($cart))->get();
      foreach ($products as $product) {
         $qty = is_array($cart[$product->id]) ? ($cart[$product->id]['quantity'] ?? 1) : $cart[$product->id];
         \App\Models\Order_detail::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $qty,
            'price' => $product->price,
            'discount' => $product->discount ?? 0,
         ]);
         // کم کردن موجودی محصول
         $product->decrement('quntity', $qty);
      }

      // ثبت پرداخت در جدول payments
      $payment = Payment::create([
         'amount' => $amount,
         // مقدار transaction به صورت عددی و یکتا
         'transaction' => time() . rand(1000, 9999),
         'status' => 'پرداخت شده',
         'order_id' => $order->id,
      ]);

      // حذف سبد خرید از سشن
      session()->forget('cart');

      return view('frontend.payment.paymentSuccess', [
         'amount' => $amount,
         'transaction_time' => Jalalian::fromDateTime($payment->created_at)->format('Y/m/d H:i'),
         'order_id' => $orderId,
         'transaction' => $payment->transaction,
      ]);
   }

   public function failed(Request $request)
   {
      $amount = $request->amount;

      // ساخت شماره سفارش یکتا و غیرتکراری
      do {
         $orderId = 'ORD-' . time() . '-' . rand(1000, 9999);
      } while (\App\Models\Payment::where('order_id', $orderId)->exists());

      // ذخیره سفارش در جدول orders با user_id
      $order = Order::create([
         'user_id' => Auth::id(),

         // سایر فیلدهای مورد نیاز جدول orders را اینجا اضافه کنید
      ]);

      // ذخیره جزییات سفارش در جدول order_details
      $cart = session()->get('cart', []);
      $products = Product::whereIn('id', array_keys($cart))->get();
      foreach ($products as $product) {
         $qty = is_array($cart[$product->id]) ? ($cart[$product->id]['quantity'] ?? 1) : $cart[$product->id];
         \App\Models\Order_detail::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $qty,
            'price' => $product->price,
            'discount' => $product->discount ?? 0,
         ]);
         
      }

      // ثبت پرداخت در جدول payments
      $payment = Payment::create([
         'amount' => $amount,
         // مقدار transaction به صورت عددی و یکتا
         'transaction' => time() . rand(1000, 9999),
         'status' => ' ناموفق',
         'order_id' => $order->id,
      ]);

      // حذف سبد خرید از سشن
      session()->forget('cart');

      return view('frontend.payment.paymentFailed', [
         'amount' => $amount,
         'transaction_time' => Jalalian::fromDateTime($payment->created_at)->format('Y/m/d H:i'),
         'order_id' => $orderId,
         'transaction' => $payment->transaction,
      ]);
      
   }
}
