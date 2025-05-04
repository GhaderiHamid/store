<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VoteController extends Controller
{
    // دریافت رأی کاربر هنگام بارگذاری صفحه
    public function show($productId)
    {
        $user = Auth::user();
        $vote = Vote::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        return response()->json([
            'value' => $vote ? $vote->value : null
        ]);
    }

    // ثبت یا جایگزینی رأی
    public function store(Request $request)
    {
        $user = Auth::user();
        $productId = $request->input('product_id');
        $value = $request->input('value');

        

        // حذف رأی قبلی اگر وجود داشته باشد
        Vote::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();

        // ثبت رأی جدید
        $vote = Vote::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'value' => $value,
        ]);

        return response()->json(['success' => true, 'message' => 'Vote saved', 'value' => $vote->value]);
    }
    
}
