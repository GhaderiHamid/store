<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReactionComment;
use App\Models\Comment;

class ReactionCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'reaction' => 'required|in:like,dislike',
        ]);

        $userId = Auth::id();
        $commentId = $request->input('comment_id');
        $reactionType = $request->input('reaction');

        $existingReaction = ReactionComment::where('user_id', $userId)
            ->where('comment_id', $commentId)
            ->first();

        if ($existingReaction) {
            if ($existingReaction->reaction !== $reactionType) {
                $existingReaction->reaction = $reactionType;
                $existingReaction->save();
            }
        } else {
            ReactionComment::create([
                'user_id' => $userId,
                'comment_id' => $commentId,
                'reaction' => $reactionType,
            ]);
        }

        $comment = Comment::with('reactions')->find($commentId);
        $thumbUpCount = $comment->reactions->where('reaction', 'like')->count();
        $thumbDownCount = $comment->reactions->where('reaction', 'dislike')->count();

        return response()->json([
            'status' => 'success',
            'thumb_up_count' => $thumbUpCount,
            'thumb_down_count' => $thumbDownCount,
        ]);
    }
}

