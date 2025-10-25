<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statuses;
class StatusController extends Controller
{
    // GET /api/statuses
    public function index()
    {
        $statuses = Statuses::all();
        return response()->json($statuses);
    }

    // POST /api/statuses
    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        $status = Statuses::create($validated);

        return response()->json([
            'message' => 'Status created successfully',
            'data' => $status
        ], 201);
    }

    // GET /api/statuses/{id}
    public function show($id)
    {
        $status = Statuses::find($id);

        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        return response()->json($status);
    }

    // PUT /api/statuses/{id}
    public function update(Request $request, $id)
    {
        $status = Statuses::find($id);
        $validated = $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        $status->update($validated);

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $status
        ]);
    }

    // DELETE /api/statuses/{id}
    public function destroy($id)
    {
        $status = Statuses::find($id);
        $status->delete();

        return response()->json(['message' => 'Status deleted successfully']);
    }
}

