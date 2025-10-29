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
    public function index(Request $request)
    {
        $user = $request->user();
        $projects = Project::with('user')->Where('user_id',$user->id)->get();
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
        ]);

        $project = Project::create([
            'title'=>$validated['title'],
            'description'=> $validated['description'],
             'user_id'=>$request->user()->id,

        ]);

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request,string $id)
    {   
        $project = Project::where('id',$id)->where('user_id',$request->user()->id)->fistOrFail();
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
        'description'=>'required|string',
    ]);

    $project = Project::where('id', $id)->where('user_id', $request->user()->id)->first();
    return response()->json([
    'message' => "Project with ID {$id} has been updated successfully.",
    'data' => $project
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request  $request ,string $id){
     $project = Project::where('id',$id)->where('user_id', $request->user()->id)->first();
    $project->delete();
    return response()->json([
        'message' => 'Delete Successfully',
        'data' => "Deleted {$id}"
    ], 200);
}
}
