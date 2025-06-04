<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $guarded = [];

    // اگر فیلدهای first_name, last_name, city, phone, address در جدول users نیستند باید اضافه شوند

    // اگر protected $fillable; استفاده می‌کنید، فیلدهای جدید را اضافه کنید
    // protected $fillable = [
    //     'first_name', 'last_name', 'email', 'password', 'city', 'phone', 'address'
    // ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function likedProducts()
    {
        return $this->belongsToMany(Product::class, 'like_products');
    }

    public function bookmarkedProducts()
    {
        return $this->belongsToMany(Product::class, 'bookmarks')->withTimestamps();
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reactions()
    {
        return $this->hasMany(ReactionComment::class, 'user_id');
    }
}
