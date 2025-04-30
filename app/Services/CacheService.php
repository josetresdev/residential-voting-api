<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CacheService
{
    public function index()
    {
        return DB::table('cache')->orderBy('key')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            DB::table('cache')->insert($data);
            return $data;
        });
    }

    public function show(string $key)
    {
        return DB::table('cache')->where('key', $key)->first();
    }

    public function update(string $key, array $data)
    {
        return DB::transaction(function () use ($key, $data) {
            DB::table('cache')->where('key', $key)->update($data);
            return DB::table('cache')->where('key', $key)->first();  // Devolvemos el elemento actualizado
        });
    }

    public function destroy(string $key)
    {
        return DB::transaction(function () use ($key) {
            return DB::table('cache')->where('key', $key)->delete();
        });
    }
}
