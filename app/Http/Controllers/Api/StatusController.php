<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StatusService;

class StatusController extends Controller
{
    protected $service;

    public function __construct(StatusService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $statuses = $this->service->getAll();

        return response()->json([
            'message' => 'Statuses retrieved successfully',
            'data' => $statuses
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        $validated['user_id'] = $request->user()->id;

        $status = $this->service->create($validated);

        return response()->json([
            'message' => 'Status created successfully',
            'data' => $status
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user()->id;

        $status = $this->service->getById($id, $userId);

        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        return response()->json([
            'message' => 'Status retrieved successfully',
            'data' => $status
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        $updated = $this->service->update($id, $validated);

        if (!$updated) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $updated
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $userId = $request->user()->id;

        $deleted = $this->service->delete($id, $userId);

        if (!$deleted) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        return response()->json(['message' => 'Status deleted successfully'], 200);
    }
}
