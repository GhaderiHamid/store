<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Support\Payment\Transaction;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   private $transaction;
   public function __construct(Transaction $transaction)
   {
    $this->transaction=$transaction;
   }
   public function verify(Request $request)
   {
    
    return $this->transaction->verify() ? $this->sendSuccessResponse() : $this->sendErrorResponse();
   
   }
   private function sendErrorResponse()
   {
      return back()->with('error','مشکلی در هنگام ثبت سفارش به وجود آمده است');
   }
   private function sendSuccessResponse()
   {
      return back()->with('success', 'سفارش شما با موفقیت ایجاد شد');
   }
   
}
