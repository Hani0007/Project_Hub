<?php
namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAllComment($userId)
    {
        return Comment::with(['user:id,name', 'project:id,title'])
            ->where('user_id', $userId)
            ->get();
    }

    public function createComment(array $data)
    {
        // FIX: Added 'user_id' in $data before calling create
        return Comment::create([
            'comment_text' => $data['comment_text'],
            'project_id' => $data['project_id'],
            'user_id' => $data['user_id'] // was missing before
        ]);
    }

    public function getCommentById($commentId, $userId)
    {
        // FIX: Added return statement (was missing, method always returned null)
        return Comment::with(['user:id,name'])
            ->where('id', $commentId)
            ->where('user_id', $userId)
            ->first();
    }

    public function updateComment($commentId, array $data, $userId)
    {
        $comment = Comment::where('id', $commentId)
            ->where('user_id', $userId)
            ->first();

        // FIX: Check null before updating (was unreachable code in old version)
        if (!$comment) {
            return null;
        }

        $comment->update($data);

        return $comment;
    }

    public function deleteComment($commentId, $userId)
    {
        $comment = Comment::where('id', $commentId)
            ->where('user_id', $userId)
            ->first();

        // FIX: Check null before delete and actually delete (was only fetching)
        if (!$comment) {
            return null;
        }

        $comment->delete();

        return $comment;
    }
}
?>
