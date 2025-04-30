<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\CacheLock;

class CacheLockService
{
    public function index()
    {
        return DB::table('cache_locks')->orderBy('key')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return DB::table('cache_locks')->insert($data);
        });
    }

    public function show(string $key)
    {
        return DB::table('cache_locks')->where('key', $key)->first();
    }

    public function update(string $key, array $data)
    {
        return DB::transaction(function () use ($key, $data) {
            DB::table('cache_locks')->where('key', $key)->update($data);
            return DB::table('cache_locks')->where('key', $key)->first();
        });
    }

    public function destroy(string $key)
    {
        return DB::transaction(function () use ($key) {
            return DB::table('cache_locks')->where('key', $key)->delete();
        });
    }
}
