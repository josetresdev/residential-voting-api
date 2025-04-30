<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        return response()->json($this->roleService->index());
    }

    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);

        $role = $this->roleService->store($validated);

        return response()->json($role, 201);
    }

    public function show(string $id)
    {
        $role = $this->roleService->show((int) $id);

        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json($role);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
        ]);

        $role = $this->roleService->update((int) $id, $validated);

        if (!$role) {
            return response()->json(['message' => 'Role not found or not updated'], 404);
        }

        return response()->json(['message' => 'Role updated successfully']);
    }

    public function destroy(string $id)
    {
        $deleted = $this->roleService->destroy((int) $id);

        if (!$deleted) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json(['message' => 'Role deleted successfully']);
    }
}
