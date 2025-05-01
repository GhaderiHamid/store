<?php

namespace App\Support\Payment\Gateways;

use App\Models\Order;
use Illuminate\Http\Request;

class Pasargad implements GatewayInterface
{
    public function pay(Order $order) 
    {
        dd('pasargad pay');
    }
    public function verify(Request $request)
     {}

    public function getName()
    {
        return 'pasargad';
    }
}
