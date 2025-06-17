<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Payment;
use App\Models\Product;
use App\Support\Payment\Transaction;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;

class PaymentController extends Controller
{

   

   public function process(Request $request)
   {
      // پردازش درخواست JSON
      if ($request->isJson()) {
         $data = $request->json()->all();

         if (!is_array($data)) {
            return response()->json(['error' => 'فرمت داده نامعتبر است!'], 400);
         }

         if (!isset($data['user_id'])) {
            return response()->json(['error' => 'شناسه کاربر موجود نیست!'], 400);
         }

         // کد کردن داده به صورت base64 برای انتقال در URL
         $encodedData = base64_encode(json_encode($data));

         return response()->json([
            'payment_url' => url('/payment/redirect?data=' . $encodedData),
            'success' => true
         ]);
      }

      // پردازش درخواست معمولی (از سایت)
      $jsonData = $request->input('data');
      if (!$jsonData) {
         return back()->withErrors('داده‌ای ارسال نشده است!');
      }

      $data = json_decode($jsonData, true);
      if (!is_array($data)) {
         return back()->withErrors('فرمت داده نامعتبر است!');
      }

      if (!isset($data['user_id'])) {
         return back()->withErrors('شناسه کاربر موجود نیست!');
      }

      $userId = $data['user_id'];
      $subtotal = $data['subtotal'] ?? 0;
      dd($subtotal);
      $products = $data['products'] ?? [];

      session()->put('payment_data', $data);
      return view('frontend.payment.all', compact('subtotal', 'userId', 'products'));
   }

   // یک روت جدید برای ریدایرکت از ربات
   public function redirectFromBot(Request $request)
   {
      $encodedData = $request->query('data');
      if (!$encodedData) {
         return redirect('/')->withErrors('داده پرداخت یافت نشد');
      }

      $data = json_decode(base64_decode($encodedData), true);
      if (!$data) {
         return redirect('/')->withErrors('داده پرداخت نامعتبر است');
      }

      $subtotal = $data['subtotal'] ?? 0;
      $userId = $data['user_id'];
      $products = $data['products'] ?? [];

      // ذخیره در session برای استفاده در مرحله پرداخت
      session()->put('payment_data', $data);

      return view('frontend.payment.all', compact('subtotal', 'userId', 'products'));
   }
  
   


   public function pay()
   {

      $data = session()->get('payment_data');

      if (!$data || !isset($data['user_id'])) {
         return back()->withErrors('داده‌ای برای پرداخت دریافت نشده است!');
      }

      // حذف داده از سشن پس از استفاده
      session()->forget('payment_data');
      
      
      $subtotal = $data['subtotal'] ?? 0;
      $userId = $data['user_id'];
      $products = $data['products'] ?? [];
      $chat_id=$data['chat_id'] ?? null;

      // پردازش پرداخت و ثبت سفارش
      $amount = $subtotal;
      do {
         $orderId = 'ORD-' . time() . '-' . rand(1000, 9999);
      } while (\App\Models\Payment::where('order_id', $orderId)->exists());

      $order = Order::create([
         'user_id' => $userId,
         'status' => 'processing',
      ]);

      foreach ($products as $product) {
         \App\Models\Order_detail::create([
            'status' => 'processing',
            'order_id' => $order->id,
            'product_id' => $product['product_id'],
            'quantity' => $product['quantity'],
            'price' => $product['price'],
            'discount' => $product['discount'] ?? 0,
         ]);
         \App\Models\Product::where('id', $product['product_id'])->decrement('quntity', $product['quantity']);
      }

      $payment = Payment::create([
         'amount' => $amount,
         'transaction' => time() . rand(1000, 9999),
         'status' => 'paid',
         'order_id' => $order->id,
      ]);

      if (session()->has('cart')) {
         session()->forget('cart');
      }
      if($chat_id!= null){
         $this->sendTelegramMessage($chat_id, '✅ پرداخت شما با موفقیت انجام شد');
      }
     
      return view(
         'frontend.payment.paymentSuccess',
         [
            'amount' => $amount,
            'transaction_time' => Jalalian::fromDateTime($payment->created_at)->format('Y/m/d H:i'),
            'order_id' => $orderId,
            'transaction' => $payment->transaction,
         ]);


   }
   public function sendTelegramMessage($chatId, $message)
   {
      $botToken = env('TELEGRAM_BOT_TOKEN');
      Http::withOptions(['verify' => false])->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
         'chat_id' => $chatId,
         'text' => $message,
      ]);
     
   }

   public function failed(Request $request)
   {
      $data = session()->get('payment_data');
      // حذف داده از سشن پس از استفاده
      session()->forget('payment_data');


      $subtotal = $data['subtotal'] ?? 0;
      $amount = $subtotal;
      $chat_id = $data['chat_id'] ?? null;

      // ساخت شماره سفارش یکتا و غیرتکراری
      do {
         $orderId = 'ORD-' . time() . '-' . rand(1000, 9999);
      } while (\App\Models\Payment::where('order_id', $orderId)->exists());

      

      
      

      // ثبت پرداخت در جدول payments
      $payment = Payment::create([
         'amount' => $amount,
         // مقدار transaction به صورت عددی و یکتا
         'transaction' => time() . rand(1000, 9999),
         'status' => 'failed',
         'order_id' => null,
      ]);

      // حذف سبد خرید از سشن
     if (session()->has('cart')) {
         session()->forget('cart');
      }
      if ($chat_id != null) {
      $this->sendTelegramMessage($chat_id, '❌ پرداخت شما ناموفق بود');
      }
      return view('frontend.payment.paymentFailed', [
         'amount' => $amount,
         'transaction_time' => Jalalian::fromDateTime($payment->created_at)->format('Y/m/d H:i'),
         'order_id' => $orderId,
         'transaction' => $payment->transaction,
      ]);
      
   }
}
