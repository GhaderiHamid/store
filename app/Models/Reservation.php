<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'quantity', 'reserved_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
