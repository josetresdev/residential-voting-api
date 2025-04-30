<?php

namespace App\Services;

use App\Models\UserRole;
use Illuminate\Support\Facades\DB;

class UserRoleService
{
    /**
     * Get a list of all user roles with relationships loaded.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return UserRole::with(['user', 'role'])->orderByDesc('created_at')->get();
    }

    /**
     * Store a new user role.
     *
     * @param array $data
     * @return \App\Models\UserRole
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            return UserRole::create($data);
        });
    }

    /**
     * Show a specific user role by its ID.
     *
     * @param string $id
     * @return \App\Models\UserRole
     */
    public function show($id)
    {
        return UserRole::with(['user', 'role'])->findOrFail($id);
    }

    /**
     * Update an existing user role.
     *
     * @param string $id
     * @param array $data
     * @return \App\Models\UserRole
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $userRole = UserRole::findOrFail($id);
            $userRole->update($data);
            return $userRole;
        });
    }

    /**
     * Delete a user role.
     *
     * @param string $id
     * @return bool|null
     */
    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $userRole = UserRole::findOrFail($id);
            return $userRole->delete();
        });
    }
}
