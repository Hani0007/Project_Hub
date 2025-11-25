<?php
namespace App\Repositories\Interfaces;

interface CommentRepositoryInterface{
    public function getAllComment($userId);
    public function createComment( array $data);
    public function getCommentById($commentId,$userId);
    public function updateComment($commentId, array $data,$userId);
    public function deleteComment($commentId,$userId);

}