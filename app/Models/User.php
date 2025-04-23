<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;





use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
   use Notifiable;
   protected $guarded = [];
   public function orders()
   {
      return $this->hasMany(Order::class);
   }
   use HasFactory;

   public function likedProducts()
   {
      return $this->belongsToMany(Product::class, 'like_products');
   }
}
// class User extends Model
// {
//    use HasFactory;
//    protected $guarded = [];

//    public function orders()
//    {
//       return $this->hasMany(Order::class);
//    }
// }
