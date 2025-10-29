<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user =  $request->user();
        $tasks = Task::with([
            'project:id,title',
            'status:id,status_name'
        ])->where('user_id',$user->id)->get();
        return response()->json([
            'message' => 'All Tasks Retrieved Successfully',
            'data' => $tasks
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'task_description' => 'required|string',
            'project_id' => 'required|exists:projects,id',
             'status_id' => 'required|exists:statuses,id',
        ]);

        $task = Task::create([
            'task_name'=> $validated['task_name'],
            'task_description'=> $validated['task_description'],
             'user_id'=>   $request->user()->id,    //authenticated user
             'project_id'=>$validated['project_id'],
             'status_id' => $validated['status_id']
        ]);

        return response()->json([
            'message' => 'Task Created Successfully',
            'data' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( Request $request , string $id)
    {
        $user = $request->user();
        $task = Task::with([
            'project:id,title',
            'status:id,status_name',
        ])->where('user_id', $user->id)->where('id',$id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task Not Found'], 404);
        }

        return response()->json([
            'message' => 'Task Retrieved Successfully',
            'data' => $task
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $request->user();
        $task = Task::where('id', $id)->where('user_id',$request->user()->id)->first();
        if (!$task) {
            return response()->json(['message' => 'Task Not Found'], 404);
        }

        $validated = $request->validate([
            'task_name' => 'sometimes|required|string|max:255',
            'task_description' => 'sometimes|required|string',
            'project_id' => 'sometimes|required|integer|exists:projects,id',
            'status_id' => 'sometimes|required|integer|exists:statuses,id',
            'comment_id' => 'nullable|integer|exists:comments,id'
        ]);

        $task->update($validated);

        return response()->json([
            'message' => 'Task Updated Successfully',
            'data' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,string $id)
    {
        $user = $request->user();
        $task = Task::where('id', $id)->where('user_id', $request->user()->id)->first();
        if (!$task) {
            return response()->json(['message' => 'Task Not Found'], 404);
        }

        $task->delete();

        return response()->json([
            'message' => 'Task Deleted Successfully'
        ], 200);
    }
}
