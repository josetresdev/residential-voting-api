<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class ActivityLogService
{
    public function index()
    {
        return ActivityLog::query()
            ->with('user')
            ->orderByDesc('created_at')
            ->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return ActivityLog::create($data);
        });
    }

    public function show($id)
    {
        return ActivityLog::with('user')->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $log = ActivityLog::findOrFail($id);
            $log->update($data);
            return $log;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $log = ActivityLog::findOrFail($id);
            $log->delete();
            return true;
        });
    }
}
