<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index(Request $request)
    {
        $projects = $this->projectService->getAllProjects($request->user()->id);
        return response()->json($projects);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['user_id'] = $request->user()->id;

        $project = $this->projectService->createProject($validated);

        return response()->json([
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $project = $this->projectService->getProject($id, $request->user()->id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        return response()->json(['data' => $project]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project = $this->projectService->updateProject($id, $validated, $request->user()->id);

        if (!$project) {
            return response()->json(['message' => 'Project not found or unauthorized'], 404);
        }

        return response()->json([
            'message' => 'Project updated successfully',
            'data' => $project
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $deleted = $this->projectService->deleteProject($id, $request->user()->id);

        if (!$deleted) {
            return response()->json(['message' => 'Project not found or unauthorized'], 404);
        }

        return response()->json(['message' => 'Project deleted successfully']);
    }
}
