<?php

namespace App\Services;

use App\Models\Role;
use App\Utils\Pagination;
use Illuminate\Support\Facades\DB;
use App\Utils\ApiResponse;

class RoleService
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        $query = Role::orderByDesc('created_at');
        $roles = Pagination::paginate($query);
        return $this->apiResponse->success($roles);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {
            $role = Role::create($data);

            return $this->apiResponse->success($role, 'Role created successfully', 201);
        });
    }

    public function show(int $id)
    {
        $role = Role::find($id);

        if (!$role) {
            return $this->apiResponse->error('Role not found', 404);
        }

        return $this->apiResponse->success($role);
    }

    public function update(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $role = Role::find($id);

            if (!$role) {
                return $this->apiResponse->error('Role not found or not updated', 404);
            }

            $role->update($data);

            return $this->apiResponse->success($role, 'Role updated successfully');
        });
    }

    public function destroy(int $id)
    {
        return DB::transaction(function () use ($id) {
            $role = Role::find($id);

            if (!$role) {
                return $this->apiResponse->error('Role not found', 404);
            }

            $role->delete();

            return $this->apiResponse->success(null, 'Role deleted successfully', 200);
        });
    }
}
