<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactionComment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'comment_id', 'reaction'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }
}
