<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['user'])->get();
        return response()->json($projects);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $project = Project::create($validated);

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $project = Project::FindOrFail($id);
         return response()->json([
         'message'=> "Project With ID {$id}",
       'data'=> $project

         ]);


    }


    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    // Validate incoming data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'user_id' => 'required|integer|exists:users,id',
        'description'=>'required|string',
    ]);
    $project = Project::findOrFail($id);
    $project->update($validatedData);
    return response()->json([
    'message' => "Project with ID {$id} has been updated successfully.",
    'data' => $project
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
    $project = Project::find($id);
    $project->delete();
    return response()->json([
        'message' => 'Delete Successfully',
        'data' => "Deleted {$id}"
    ], 200);
}
}
