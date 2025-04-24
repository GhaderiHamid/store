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
   public function bookmarkedProducts()
   {
      return $this->belongsToMany(Product::class, 'bookmarks')->withTimestamps();
   }
}
