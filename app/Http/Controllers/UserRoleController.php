<?php

namespace App\Http\Controllers;

use App\Services\UserRoleService;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    protected $userRoleService;

    public function __construct(UserRoleService $userRoleService)
    {
        $this->userRoleService = $userRoleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRoles = $this->userRoleService->index();
        return response()->json($userRoles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        // Crear el UserRole
        $userRole = $this->userRoleService->store($validated);

        return response()->json($userRole, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userRole = $this->userRoleService->show($id);

        if (!$userRole) {
            return response()->json(['message' => 'UserRole not found'], 404);
        }

        return response()->json($userRole);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|integer|exists:users,id',
            'role_id' => 'nullable|integer|exists:roles,id',
        ]);

        $updated = $this->userRoleService->update($id, $validated);

        if (!$updated) {
            return response()->json(['message' => 'UserRole not found or not updated'], 404);
        }

        return response()->json(['message' => 'UserRole updated successfully']);
    }

    public function destroy(string $id)
    {
        $deleted = $this->userRoleService->destroy($id);

        if (!$deleted) {
            return response()->json(['message' => 'UserRole not found'], 404);
        }

        return response()->json(['message' => 'UserRole deleted successfully']);
    }
}
