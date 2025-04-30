<?php

namespace App\Http\Controllers;

use App\Services\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->jobService = $jobService;
    }

    public function index()
    {
        $jobs = $this->jobService->index();
        return response()->json($jobs);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'queue' => 'required|string',
            'payload' => 'required|string',
            'attempts' => 'nullable|integer',
            'reserved_at' => 'nullable|integer',
            'available_at' => 'nullable|integer',
        ]);

        $job = $this->jobService->store($data);
        return response()->json($job, 201);
    }

    public function show(string $id)
    {
        $job = $this->jobService->show((int) $id);

        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        return response()->json($job);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'queue' => 'required|string',
            'payload' => 'required|string',
            'attempts' => 'nullable|integer',
            'reserved_at' => 'nullable|integer',
            'available_at' => 'nullable|integer',
        ]);

        $job = $this->jobService->update((int) $id, $data);

        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        return response()->json($job);
    }

    public function destroy(string $id)
    {
        $deleted = $this->jobService->destroy((int) $id);

        if (!$deleted) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        return response()->json(['message' => 'Job deleted successfully']);
    }
}
