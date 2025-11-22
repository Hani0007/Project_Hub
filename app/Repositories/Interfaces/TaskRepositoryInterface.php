<?php
namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface {

    public function getAllTasksByUser($userId);

    public function createTask(array $data);

    public function getTaskById($userId, $taskId);

    public function updateTask($taskId, array $data, $userId);

    public function deleteTask($taskId, $userId);
}
