<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{

    public function toggleBookmark(Request $request)
    {
        $user = Auth::user();
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
            // اگر لایک نکرده بود، اضافه می‌کنیم
            Bookmark::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return response()->json(['status' => 'bookmarked']);
        }
    }
    public function getBookmarkStatus(Request $request)
    {
        $user = Auth::user();
        $productId = $request->product_id;

        $bookmarked = Bookmark::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->exists();

        return response()->json(['bookmarked' => $bookmarked]);
    }
}
