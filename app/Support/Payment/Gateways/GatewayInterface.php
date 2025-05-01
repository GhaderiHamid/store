<?php

namespace App\Support\Payment\Gateways;

use App\Models\Order;
use Illuminate\Http\Request;

interface  GatewayInterface
{

    const TRANSACTION_FAILED='پرداخت انجام نشد';
    const TRANSACTION_SUCCESS='پرداخت انجام شد';
    public function pay(Order $order);
    public function verify(Request $request);
    public function getName();
}