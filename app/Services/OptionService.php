<?php

namespace App\Services;

use App\Models\Option;
use Illuminate\Support\Facades\DB;

class OptionService
{
    public function index()
    {
        return Option::orderByDesc('created_at')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Option::create($data);
        });
    }

    public function show(int $id)
    {
        return Option::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $option = Option::findOrFail($id);
            $option->update($data);
            return $option;
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $option = Option::findOrFail($id);
            return $option->delete();
        });
    }
}
