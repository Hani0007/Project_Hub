<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * (Shows only projects owned by the authenticated user)
     */
    public function index(Request $request)
    {
        $user = $request->user(); // authenticated user
        $projects = Project::with('user')
            ->where('user_id', $user->id)
            ->get();

        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Automatically assign authenticated user ID
        $project = Project::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $project = Project::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        return response()->json([
            'message' => "Project with ID {$id}",
            'data' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = Project::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $project->update($validatedData);

        return response()->json([
            'message' => "Project with ID {$id} has been updated successfully.",
            'data' => $project
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $project = Project::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $project->delete();

        return response()->json([
            'message' => 'Deleted successfully',
            'data' => "Deleted project ID {$id}"
        ], 200);
    }
}
