<?php

namespace App\Services;

use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class JobService
{
    public function index()
    {
        return Job::orderByDesc('created_at')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Job::create($data);
        });
    }

    public function show(int $id): Job
    {
        return Job::findOrFail($id);
    }

    public function update(int $id, array $data): Job
    {
        return DB::transaction(function () use ($id, $data) {
            $job = Job::findOrFail($id);
            $job->update($data);
            return $job;
        });
    }

    public function destroy(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $job = Job::findOrFail($id);
            return (bool) $job->delete();
        });
    }
}
