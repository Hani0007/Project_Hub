<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAllTasksByUser($userId)
    {
        return Task::with([
            'project:id,title',
            'status:id,status_name'
        ])->where('user_id', $userId)->get();
    }

    public function createTask(array $data)
    {
        return Task::create($data);
    }

    public function getTaskById($userId, $taskId)
    {
        return Task::with([
            'project:id,title',
            'status:id,status_name'
        ])
        ->where('id', $taskId)
        ->where('user_id', $userId)
        ->first();
    }

    public function updateTask($taskId, array $data, $userId)
    {
        return Task::where('id', $taskId)
            ->where('user_id', $userId)
            ->update($data);
    }

    public function deleteTask($taskId, $userId)
    {
        return Task::where('id', $taskId)
            ->where('user_id', $userId)
            ->delete();
    }
}
