<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Payment\PaymentService;
use App\Services\Payment\Requests\IDPayRequest;

 
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay()
    {
        $user=User::first();
        $idPayRequest = new IDPayRequest(
            [
           'price'=>20000,
            'user'=>$user,
         ]);
         $paymentService=new PaymentService(PaymentService::IDPAY, $idPayRequest);
         $paymentService->pay();
         dd($paymentService->pay());
    }
    
}
