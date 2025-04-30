<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    protected $activityLogService;

    public function __construct(ActivityLogService $activityLogService)
    {
        $this->activityLogService = $activityLogService;
    }

    public function index()
    {
        $logs = $this->activityLogService->index();
        return response()->json($logs);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'action' => 'required|string|max:255',
            'details' => 'nullable|string',
        ]);

        $log = $this->activityLogService->store($data);
        return response()->json($log, 201);
    }

    public function show(string $id)
    {
        $log = $this->activityLogService->show($id);
        return response()->json($log);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'action' => 'string|max:255',
            'details' => 'nullable|string',
        ]);

        $log = $this->activityLogService->update($id, $data);
        return response()->json($log);
    }

    public function destroy(string $id)
    {
        $this->activityLogService->destroy($id);
        return response()->json(['message' => 'Activity log deleted successfully']);
    }
}
