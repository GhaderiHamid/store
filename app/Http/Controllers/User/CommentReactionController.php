<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CommentReaction;
use Illuminate\Http\Request;

class CommentReactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'reaction' => 'required|in:like,dislike',
        ]);

        $existingReaction = CommentReaction::where('comment_id', $request->comment_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReaction) {
            if ($existingReaction->reaction === $request->reaction) {
                $existingReaction->delete();
                return response()->json(['success' => true, 'message' => 'واکنش حذف شد']);
            } else {
                $existingReaction->delete();
            }
        }

        $reaction = CommentReaction::create([
            'comment_id' => $request->comment_id,
            'user_id' => auth()->id(),
            'reaction' => $request->reaction,
        ]);

        return response()->json(['success' => true, 'reaction' => $reaction]);
    }

    public function getReactions($commentId)
    {
        $likeCount = CommentReaction::where('comment_id', $commentId)->where('reaction', 'like')->count();
        $dislikeCount = CommentReaction::where('comment_id', $commentId)->where('reaction', 'dislike')->count();

        return response()->json([
            'like_count' => $likeCount,
            'dislike_count' => $dislikeCount,
        ]);
    }
}
