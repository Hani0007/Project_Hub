<?php
namespace App\Services;

use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentService 
{
    protected $commentRepository; // FIX: Use lowercase for convention

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    } 

    public function getAllComments($userId)
    {
        return $this->commentRepository->getAllComment($userId);
    }

    public function createComment(array $data)
    {
        return $this->commentRepository->createComment($data);
    }

    public function getCommentById($commentId, $userId)
    {
        return $this->commentRepository->getCommentById($commentId, $userId);
    }

    public function updateComment($commentId, array $data, $userId)
    {
        return $this->commentRepository->updateComment($commentId, $data, $userId);
    }

    public function deleteComment($commentId, $userId)
    {
        return $this->commentRepository->deleteComment($commentId, $userId);
    }
}
?>
