<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    public $guarded=[];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function status_order_detail()
    {
        return $this->belongsTo(Status_order_detail::class, 'status_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
