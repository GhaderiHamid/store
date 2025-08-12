<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LikeProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $user = Auth::guard('web')->user();
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
        $user = Auth::guard('web')->user();
        $productId = $request->product_id;

        $liked = LikeProduct::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['liked' => $liked]);
    }

    public function getLikedProducts()
    {
        $user = Auth::guard('web')->user();
        $likedProducts = Product::whereIn('id', function ($query) use ($user) {
            $query->select('product_id')
                ->from('like_products')
                ->where('user_id', $user->id);
        })->paginate(20);

        return view('frontend.product.liked', compact('likedProducts'));
    }

    public function unlikeProduct(Request $request)
    {
        $user = Auth::guard('web')->user();
        $productId = $request->product_id;

        LikeProduct::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->delete();

        return response()->json(['status' => 'unliked']);
    }

    // تعداد لایک‌های یک محصول را به صورت json برمی‌گرداند
    public function likeCount($productId)
    {
        $count = LikeProduct::where('product_id', $productId)->count();
        return response()->json(['likeCount' => $count]);
    }
}
