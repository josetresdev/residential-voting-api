<?php

namespace App\Services;

use App\Models\UserRole;
use Illuminate\Support\Facades\DB;

class UserRoleService
{
    public function index()
    {
        return UserRole::with(['user', 'role'])->get();
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return UserRole::create($data);
        });
    }

    public function show($id)
    {
        return UserRole::with(['user', 'role'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $userRole = UserRole::findOrFail($id);
            $userRole->update($data);
            return $userRole;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $userRole = UserRole::findOrFail($id);
            return $userRole->delete();
        });
    }
}
