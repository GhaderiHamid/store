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
    return $this->belongsTo(User::class, 'user_id');
  }



  
  public function payment()
  {
    return $this->hasOne(Payment::class,'order_id');
  }
  public function order_detail()
  {
    return $this->hasMany(Order_detail::class);
  }

  public function products()
  {
    return $this->belongsToMany(Product::class, 'order_details')->withPivot('quantity', 'price', 'discount');
                
  }
  public function details()
  {
    return $this->hasMany(Order_detail::class);
  }

  public function getTotalAmount()
  {
    return $this->details()->sum('price');
  }
  public function sendShipper()
  {
    return $this->belongsTo(Shipper::class, 'send_shipper');
  }
  public function receiveShipper()
  {
    return $this->belongsTo(Shipper::class, 'receive_shipper');
  }
}
