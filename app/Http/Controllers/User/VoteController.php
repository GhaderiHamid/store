<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    // دریافت رأی فعلی کاربر
    public function show($productId)
    {
        $user = Auth::guard('web')->user();
        
        if (!$user) return response()->json(['value' => null]);

        $vote = Vote::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        return response()->json(['value' => $vote?->value]);
    }

    // ثبت یا بروزرسانی رأی
    public function store(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) return response()->json(['success' => false], 401);

        $vote = Vote::updateOrCreate(
            ['user_id' => $user->id, 'product_id' => $request->product_id],
            ['value' => $request->value]
        );

        return response()->json([
            'success' => true,
            'value' => $vote->value
        ]);
    }
}
