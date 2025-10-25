<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
    // GET /api/comments
    public function index()
    {
        $comments = Comment::with(['user:id,name', 'task:id,task_name'])->get();

        return response()->json([
            'message' => 'All comments retrieved successfully',
            'data' => $comments
        ]);
    }

    // POST /api/comments
    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment_text' => 'required|string|max:500',
            'user_id' => 'required|integer|exists:users,id',
            'task_id' => 'required|integer|exists:tasks,id',
        ]);

        $comment = Comment::create($validated);

        return response()->json([
            'message' => 'Comment created successfully',
            'data' => $comment
        ], 201);
    }

    // GET /api/comments/{id}
    public function show($id)
    {
        $comment = Comment::with(['user:id,name', 'task:id,task_name'])->find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json([
            'message' => 'Comment retrieved successfully',
            'data' => $comment
        ]);
    }

    // PUT /api/comments/{id}
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $validated = $request->validate([
            'comment_text' => 'required|string|max:500',
        ]);

        $comment->update($validated);

        return response()->json([
            'message' => 'Comment updated successfully',
            'data' => $comment
        ]);
    }

    // DELETE /api/comments/{id}
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}

