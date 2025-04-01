<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_order extends Model
{
    use HasFactory;
    public $guarded = [];

    public function orders(){
        return $this->hasMany(Order::class);
    }
    
}
