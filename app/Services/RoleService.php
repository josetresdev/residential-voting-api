<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleService
{
    public function index()
    {
        return Role::orderByDesc('created_at')->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return Role::create($data);
        });
    }

    public function show(int $id)
    {
        return Role::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $role = Role::findOrFail($id);
            $role->update($data);
            return $role;
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $role = Role::findOrFail($id);
            return $role->delete();
        });
    }
}
