<?php

namespace App\Services;

use App\Models\UserRole;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;

class UserRoleService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $userRoles = UserRole::with(['user', 'role'])->orderByDesc('created_at')->get();
        return $this->apiResponse->success($userRoles);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $userRole = UserRole::create($data);
            return $this->apiResponse->success($userRole, 'User role created successfully', 201);
        });
    }

    public function show($id)
    {
        $userRole = UserRole::with(['user', 'role'])->find($id);

        if (!$userRole) {
            return $this->apiResponse->error('User role not found', 404);
        }

        return $this->apiResponse->success($userRole);
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $userRole = UserRole::find($id);

            if (!$userRole) {
                return $this->apiResponse->error('User role not found or not updated', 404);
            }

            $userRole->update($data);
            return $this->apiResponse->success($userRole, 'User role updated successfully');
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $userRole = UserRole::find($id);

            if (!$userRole) {
                return $this->apiResponse->error('User role not found', 404);
            }

            $userRole->delete();
            return $this->apiResponse->success(null, 'User role deleted successfully', 204);
        });
    }
}
