<?php

namespace App\Services;

use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getTasksByUser($userId)
    {
        return $this->taskRepository->getAllTasksByUser($userId);
    }

    public function createTask(array $data, $userId)
    {
        $data['user_id'] = $userId; // set authenticated user
        return $this->taskRepository->createTask($data);
    }

    public function getTaskById($userId, $taskId)
    {
        return $this->taskRepository->getTaskById($userId, $taskId);
    }

    public function updateTask($taskId, array $data, $userId)
    {
        return $this->taskRepository->updateTask($taskId, $data, $userId);
    }

    public function deleteTask($taskId, $userId)
    {
        return $this->taskRepository->deleteTask($taskId, $userId);
    }
}
