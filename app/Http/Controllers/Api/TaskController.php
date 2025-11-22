<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $tasks = $this->taskService->getTasksByUser($userId);

        return response()->json([
            'message' => 'All Tasks Retrieved Successfully',
            'data' => $tasks
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'task_description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        $task = $this->taskService->createTask($validated, $request->user()->id);

        return response()->json([
            'message' => 'Task Created Successfully',
            'data' => $task
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;

        $task = $this->taskService->getTaskById($userId, $id);

        if (!$task) {
            return response()->json(['message' => 'Task Not Found'], 404);
        }

        return response()->json([
            'message' => 'Task Retrieved Successfully',
            'data' => $task
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'task_name' => 'sometimes|string|max:255',
            'task_description' => 'sometimes|string',
            'project_id' => 'sometimes|exists:projects,id',
            'status_id' => 'sometimes|exists:statuses,id',
        ]);

        $userId = $request->user()->id;

        $updated = $this->taskService->updateTask($id, $validated, $userId);

        if (!$updated) {
            return response()->json(['message' => 'Task Not Found'], 404);
        }

        return response()->json([
            'message' => 'Task Updated Successfully'
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $userId = $request->user()->id;

        $deleted = $this->taskService->deleteTask($id, $userId);

        if (!$deleted) {
            return response()->json(['message' => 'Task Not Found'], 404);
        }

        return response()->json([
            'message' => 'Task Deleted Successfully'
        ], 200);
    }
}
