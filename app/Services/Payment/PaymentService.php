<?php

namespace App\Services\Payment;

use App\Services\Payment\Contracts\RequestInterface;


use App\Services\Payment\Exceptions\ProviderNotFoundException;
use App\Services\Payment\Requests\IDPayRequest;

class PaymentService
{
    public const IDPAY='IDPayProvider';
    public const ZARINPAL = 'ZarinpalProvider';

   
    private $providerName;
    private $request;

    // public function __construct(string $providerName, RequestInterface $request)
    // {
    //     $this->providerName = $providerName;
    //     $this->request = $request;
    // }
    

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }


    public function pay(){
        dd($this->findProvider()->pay());
     return $this->findProvider();
    }

    public function findProvider()
    {
        $className='App\\Services\\Payment\\Providers\\'. $this->providerName;
     
        if(!class_exists($className))
        {
            throw new ProviderNotFoundException('درگاه پرداخت انتخاب شده پیدا نشد');
        }
          return new $className($this->request);
    }

} 
// $idPayRequest=new IDPayRequest([
//     'price'=>20000,
//     'user'=>$user,
// ]);
// $paymentService=new PaymentService(PaymentService::IDPAY, $idPayRequest);
// $paymentService->pay();