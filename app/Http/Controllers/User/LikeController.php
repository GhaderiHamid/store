<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LikeProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $user = Auth::user();
        $productId = $request->product_id;

        $likeExists = LikeProduct::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();
        if ($likeExists) {
            LikeProduct::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->delete();
            return response()->json(['status' => 'unliked']);
        }else {
            // اگر لایک نکرده بود، اضافه می‌کنیم
            LikeProduct::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return response()->json(['status' => 'liked']);
        }
    }
    public function getLikeStatus(Request $request)
    {
        $user = Auth::user();
        $productId = $request->product_id;

        $liked = LikeProduct::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['liked' => $liked]);
    }
}
