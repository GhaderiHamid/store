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

    public function bookmarkedProducts()
    {
        $user = Auth::user();
        $bookmarkedProducts = Product::whereIn('id', Bookmark::where('user_id', $user->id)->pluck('product_id'))->get();

        return view('frontend.product.bookmarked', compact('bookmarkedProducts'));
    }

    public function unbookmark(Request $request)
    {
        $user = Auth::user();
        Bookmark::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->delete();

        return response()->json(['status' => 'unBookmarked']);
    }
}
