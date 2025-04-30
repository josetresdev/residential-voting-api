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
        return $this->roleService->index();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'nullable|array',
        ]);
        
        return $this->roleService->store($validated);
    }

    public function show(string $id)
    {
        return $this->roleService->show((int) $id);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|unique:roles,name,' . $id,
            'permissions' => 'nullable|array',
        ]);

        return $this->roleService->update((int) $id, $validated);
    }

    public function destroy(string $id)
    {
        return $this->roleService->destroy((int) $id);
    }
}
