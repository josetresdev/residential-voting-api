<?php

namespace App\Services;

use App\Models\User;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Utils\ApiResponse;
use Illuminate\Support\Str;

class UserService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $query = User::with(['roles'])->orderByDesc('created_at');
        $users = Pagination::paginate($query);
        return $this->apiResponse->success($users);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['uuid'] = Str::uuid()->toString();

            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }

            return $this->apiResponse->success($user, 'User created successfully', 201);
        });
    }
    public function show($id)
    {
        $user = User::with(['roles'])->find($id);

        if (!$user) {
            return $this->apiResponse->error('User not found', 404);
        }

        return $this->apiResponse->success($user);
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

            return $this->apiResponse->success($user, 'User updated successfully');
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $user = User::findOrFail($id);

            $user->roles()->detach();

            $user->delete();

            return $this->apiResponse->success(null, 'User deleted successfully', 200);
        });
    }

}
