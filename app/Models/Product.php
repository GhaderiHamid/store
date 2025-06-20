<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

   public function category(){
    return $this->belongsTo(Category::class, 'category_id');
   }
   public function order_details(){
    return $this->hasMany(Order_detail::class);

   }
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'like_products');
    }
    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks');
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function hasStock(int $quantity)
    {
        return $this->quntity > $quantity;
    }
    public function decrementQuantity(int $count)
    {
        return $this->decrement('quntity',$count);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
