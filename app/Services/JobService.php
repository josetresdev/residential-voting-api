<?php

namespace App\Services;

use App\Models\Job;
use Illuminate\Support\Facades\DB;

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

    public function show(int $id)
    {
        return Job::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $job = Job::findOrFail($id);
            $job->update($data);
            return $job;
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $job = Job::findOrFail($id);
            return $job->delete();
        });
    }
}
