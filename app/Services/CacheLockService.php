<?php

namespace App\Services;

use App\Models\CacheLock;
use Illuminate\Support\Facades\DB;

class CacheLockService
{
    public function index()
    {
        return CacheLock::orderBy('key')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return CacheLock::create($data);
        });
    }

    public function show(string $key)
    {
        return CacheLock::where('key', $key)->firstOrFail();
    }

    public function update(string $key, array $data)
    {
        return DB::transaction(function () use ($key, $data) {
            $lock = CacheLock::where('key', $key)->firstOrFail();
            $lock->update($data);
            return $lock;
        });
    }

    public function destroy(string $key)
    {
        return DB::transaction(function () use ($key) {
            $lock = CacheLock::where('key', $key)->firstOrFail();
            return $lock->delete();
        });
    }
}
