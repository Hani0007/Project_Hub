<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statuses;
class StatusController extends Controller
{
    // GET /api/statuses
 // In StatusController
public function index(Request $request)
{
    $user = $request->user(); // authenticated user via Sanctum

    $statuses = Statuses::all();

    return response()->json([
        'message' => 'Statuses retrieved successfully',
        'data' => $statuses
    ], 200);
}


    // POST /api/statuses
    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        //Attaching Authenticated User With Status
         $validated['user_id'] = $request->user()->id;
        $status = Statuses::create($validated);
        return response()->json([
            'message' => 'Status created successfully',
            'data' => $status
        ], 201);
    }

    // GET /api/statuses/{id}
    public function show(Request $request, $id)
{
    $user = $request->user();
    $status = Statuses::where('id', $id)
        ->where('user_id', $user->id)
        ->first();

    if (!$status) {
        return response()->json(['message' => 'Status not found'], 404);
    }

    return response()->json([
        'message' => 'User-specific status retrieved successfully',
        'data' => $status
    ], 200);
}


  // PUT /api/statuses/{id}
public function update(Request $request, $id)
{
    $user = $request->user();
    $status = Statuses::find($id);
    if (!$status) {
        return response()->json(['message' => 'Status not found'], 404);
    }

    // Validate input
    $validated = $request->validate([
        'status_name' => 'required|string|max:255',
    ]);

    // Update the status
    $status->update($validated);

    return response()->json([
        'message' => 'Status updated successfully',
        'data' => $status,
    ], 200);
}

 // DELETE /api/statuses/{id}
public function destroy(Request $request, $id)
{
    // Ensure user is authenticated
    $user = $request->user();

    // Find the status
    $status = Statuses::find($id);

    // Handle not found
    if (!$status) {
        return response()->json(['message' => 'Status not found'], 404);
    }

    $status->delete();

    return response()->json(['message' => 'Status deleted successfully'], 200);
}
}
