<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $comments = $this->commentService->getAllComments($userId);

        return response()->json([
            'message' => 'All comments retrieved successfully',
            'data' => $comments
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment_text' => 'required|string',
            'project_id' => 'required|exists:projects,id'
        ]);

        // FIX: Attach authenticated user_id
        $validated['user_id'] = $request->user()->id;

        $comment = $this->commentService->createComment($validated);

        return response()->json([
            'message' => 'Comment created successfully',
            'data' => $comment
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;
        $comment = $this->commentService->getCommentById($id, $userId);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found'], 404);
        }

        return response()->json([
            'message' => 'Comment retrieved successfully',
            'data' => $comment
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comment_text' => 'required|string|max:1000',
        ]);

        $userId = $request->user()->id;

        // FIX: Use service to update comment, removing redundant DB query
        $comment = $this->commentService->updateComment($id, $validated, $userId);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found or unauthorized'], 404);
        }

        return response()->json([
            'message' => 'Comment updated successfully',
            'data' => $comment
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $userId = $request->user()->id;

        // FIX: Use service to delete comment
        $comment = $this->commentService->deleteComment($id, $userId);

        if (!$comment) {
            return response()->json(['message' => 'Comment not found or unauthorized'], 404);
        }

        return response()->json(['message' => 'Comment deleted successfully']);
    }
}
?>
