<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{

    public function toggleBookmark(Request $request)
    {
        $user = Auth::guard('web')->user();
        $productId = $request->product_id;

        $bookmarkExists = Bookmark::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();
        if ($bookmarkExists) {
            Bookmark::where('user_id', $user->id)
                ->where('product_id', $productId)
                ->delete();
            return response()->json(['status' => 'unBookmarked']);
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return response()->json(['status' => 'bookmarked']);
        }
    }

    public function getBookmarkStatus(Request $request)
    {
        $user = Auth::guard('web')->user();
        $productId = $request->product_id;

        $bookmarked = Bookmark::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['bookmarked' => $bookmarked]);
    }

    public function bookmarkedProducts()
    {
        $user = Auth::guard('web')->user();

        // گرفتن آی‌دی محصولات بوکمارک‌شده
        $bookmarkedProductIds = Bookmark::where('user_id', $user->id)->pluck('product_id');

        // صفحه‌بندی محصولات
        $bookmarkedProducts = Product::whereIn('id', $bookmarkedProductIds)->paginate(20); // مثلاً 10 محصول در هر صفحه

        return view('frontend.product.bookmarked', compact('bookmarkedProducts'));
    }

    public function unbookmark(Request $request)
    {
        $user = Auth::guard('web')->user();
        Bookmark::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json(['status' => 'unBookmarked']);
    }
}
