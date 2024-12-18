<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function editComment(Request $request, $commentId)
    {
        // Validate the request
        $request->validate([
            'comment' => 'required',
        ]);
        $comment = Comment::find($commentId);
        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }

        if ((int)$comment->user_id !== (int)Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Update the comment
        $comment->comment = $request->comment;
        $comment->save();

        if($comment->booking_id) {
            return response()->json([
                'message' => "Comment Updated Successfully",
                'comment' => $comment->comment,
            ]);
        }
        if($comment->fine_id) {
            return response()->json([
                'message' => "Note Updated Successfully",
                'comment' => $comment->comment,
            ]);
        }
    }

    public function deleteComment($commentId)
    {
        // Find the comment
        $comment = Comment::find($commentId);

        // Check if comment exists
        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
        if ((int)$comment->user_id !== (int)Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $comment->delete();

        if($comment->booking_id) {
            return response()->json(['message' => 'Comment deleted successfully']);
        }
        if($comment->fine_id) {
            return response()->json(['message' => 'Note deleted successfully']);
        }

    }
}
