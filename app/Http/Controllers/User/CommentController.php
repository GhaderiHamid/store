<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
            'comment_text' => $request->input('comment_text'),
        ]);

        return redirect()->back()->with('success', 'دیدگاه شما با موفقیت ثبت شد.');
    }
}
