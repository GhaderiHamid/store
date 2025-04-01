<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
   
    // public function order_detail()
    // {
    //     return $this->belongsTo(Order_detail::class);
    // }
    // public function payment()
    // {
    //     return $this->hasOne(Payment::class);
    // }
    public function status_order(){
      return $this->belongsTo(Status_order::class, 'status_id');  
    }
   
}