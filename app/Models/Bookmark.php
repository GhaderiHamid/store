<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id'];

    /**
     * رابطه با کاربر
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * رابطه با محصول
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
