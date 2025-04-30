<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserRoleService;
use App\Utils\ApiResponse;

class UserRoleController extends Controller
{
    protected $userRoleService;

    public function __construct(UserRoleService $userRoleService)
    {
        $this->userRoleService = $userRoleService;
    }

    public function index()
    {
        return $this->userRoleService->index();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        return $this->userRoleService->store($validated);
    }

    public function show(string $id)
    {
        $userRole = $this->userRoleService->show($id);

        if (!$userRole) {
            return ApiResponse::notFound('UserRole not found');
        }

        return ApiResponse::success($userRole);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'role_id' => 'nullable|integer|exists:roles,id',
        ]);

        $updated = $this->userRoleService->update($id, $validated);

        if (!$updated) {
            return ApiResponse::notFound('UserRole not found or not updated');
        }

        return ApiResponse::success(null, 'UserRole updated successfully');
    }

    public function destroy(string $id)
    {
        $deleted = $this->userRoleService->destroy($id);

        if (!$deleted) {
            return ApiResponse::notFound('UserRole not found');
        }

        return ApiResponse::success(null, 'UserRole deleted successfully');
    }
}
