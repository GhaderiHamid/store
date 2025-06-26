<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $guarded = [];

    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    //    public function confirm(string $refNum,string $gateway)
    //    {
    //     // $this->ref_num=$refNum;
    //     $this->gateway=$gateway;
    //     $this->status='ok';
    //     $this->save();
    //    }
    
}