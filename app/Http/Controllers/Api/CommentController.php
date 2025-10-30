<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    // ✅ GET /api/comments (Requires Sanctum Auth)
    public function index(Request $request)
    {
        $comments = Comment::with(['user:id,name', 'task:id,task_name'])
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json([
            'message' => 'All comments retrieved successfully',
            'data' => $comments
        ], 200);
    }

   public function store(Request $request)
{
    $user = $request->user();

    $validated = $request->validate([
        'comment_text' => 'required|string',
        'project_id' => 'required|exists:projects,id'
    ]);

    $comment = Comment::create([
        'comment_text' => $validated['comment_text'],
        'project_id' => $validated['project_id'],
        'user_id' => $user->id
    ]);

    return response()->json([
        'message' => 'Comment created successfully',
        'data' => $comment
    ], 201);
}

    // ✅ GET /api/comments/{id} (Requires Sanctum Auth)
    public function show(Request $request, $id)
    {
        $comment = Comment::with(['user:id,name'])
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json([
            'message' => 'Comment retrieved successfully',
            'data' => $comment
        ]);
    }

    // ✅ PUT /api/comments/{id} (Requires Sanctum Auth)
    public function update(Request $request, $id)
    {
        $comment = Comment::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$comment) {
            return response()->json(['message' => 'Comment not found or unauthorized'], 404);
        }

        $validated = $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return response()->json([
            'message' => 'Comment updated successfully',
            'data' => $comment
        ]);
    }

    // ✅ DELETE /api/comments/{id} (Requires Sanctum Auth)
    public function destroy(Request $request, $id)
    {
        $comment = Comment::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$comment) {
            return response()->json(['message' => 'Comment not found or unauthorized'], 404);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
