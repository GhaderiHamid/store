<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Reservation;
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
      $user = \App\Models\User::find($userId);
      if (!$user || !$user->city || !$user->address) {
         return back()->withErrors('لطفاً ابتدا اطلاعات شهر و آدرس خود را در پروفایل تکمیل نمایید.');
      }

      // $subtotal = $data['subtotal'] ?? 0;
      $products = $data['products'] ?? [];
      $subtotal = 0;

      foreach ($products as $p) {
         $subtotal += round($p['final_price'] ?? 0) * intval($p['quantity'] ?? 1);
      }
      
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

      $subtotal = $data['subtotal'] ?? 0;
      $userId = $data['user_id'];
      $products = $data['products'] ?? [];
      $chat_id = $data['chat_id'] ?? null;

      // 🛡️ بررسی رزرو و موجودی هر محصول
      foreach ($products as $p) {
         $product = Product::find($p['product_id']);

       

         if (!$product|| $product->quntity < $p['quantity']) 
         {
            return back()->withErrors(provider: "محصول «{$p['name']}» شما موجودی ندارد.");
         }
         
      }

      // ✅ رزروها معتبر هستن، ادامه بده
      session()->forget('payment_data');
      if (session()->has('cart')) {
         session()->forget('cart');
      }
      Reservation::where('user_id', $userId)->delete();

      $order = Order::create([
         'user_id' => $userId,
         'status' => 'processing',
      ]);

      foreach ($products as $product) {
         Order_detail::create([
            'status' => 'processing',
            'order_id' => $order->id,
            'product_id' => $product['product_id'],
            'quantity' => $product['quantity'],
            'price' => $product['price'],
            'discount' => $product['discount'] ?? 0,
         ]);

         Product::where('id', $product['product_id'])
            ->decrement('quntity', $product['quantity']);
      }

      do {
         $orderId = 'ORD-' . time() . '-' . rand(1000, 9999);
      } while (Payment::where('order_id', $orderId)->exists());

      $payment = Payment::create([
         'amount' => $subtotal,
         'transaction' => time() . rand(1000, 9999),
         'status' => 'paid',
         'order_id' => $order->id,
         'user_id' => $userId,
      ]);

      if ($chat_id !== null) {
         $this->sendTelegramMessage($chat_id, '✅ پرداخت شما با موفقیت انجام شد');
      }

      return view('frontend.payment.paymentSuccess', [
         'amount' => $subtotal,
         'transaction_time' => Jalalian::fromDateTime($payment->created_at)->format('Y/m/d H:i'),
         'order_id' => $orderId,
         'transaction' => $payment->transaction,
      ]);
   }
   public function sendTelegramMessage($chatId, $message)
   {
      $botToken = config('services.telegram.bot_token');
      Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
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
      $userId = $data['user_id'];
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
         'user_id' => $userId,
      ]);

      // حذف سبد خرید از سشن
     if (session()->has('cart')) {
         session()->forget('cart');
     }
         Reservation::where('user_id', $data['user_id'])->delete();
      
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
