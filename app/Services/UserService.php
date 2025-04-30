<?php

namespace App\Services;

use App\Models\User;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function index()
    {
        $query = User::with(['roles'])->orderByDesc('created_at');
        return Pagination::paginate($query);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

            return $user;
        });
    }

    public function show($id)
    {
        return User::with(['roles'])->findOrFail($id);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $user = User::findOrFail($id);

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);

            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

            return $user;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);
            $user->roles()->detach();
            return $user->delete();
        });
    }
}
