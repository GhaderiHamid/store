<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_order_detail extends Model
{
    use HasFactory;
    public $guarded = [];
    public function order_details()
    {
        return $this->hasMany(Order_detail::class);
    }
}
