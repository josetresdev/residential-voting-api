<?php

namespace App\Http\Controllers;

use App\Services\PasswordResetService;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    protected $passwordResetService;

    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passwordResets = $this->passwordResetService->index();
        return response()->json($passwordResets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        $passwordReset = $this->passwordResetService->store($data);
        return response()->json($passwordReset, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $passwordReset = $this->passwordResetService->show((int) $id);

        if (!$passwordReset) {
            return response()->json(['message' => 'Password reset request not found'], 404);
        }

        return response()->json($passwordReset);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
        ]);

        $updated = $this->passwordResetService->update((int) $id, $data);

        if (!$updated) {
            return response()->json(['message' => 'Password reset request not found or not updated'], 404);
        }

        return response()->json(['message' => 'Password reset updated successfully']);
    }

    public function destroy(string $id)
    {
        $deleted = $this->passwordResetService->destroy((int) $id);

        if (!$deleted) {
            return response()->json(['message' => 'Password reset request not found'], 404);
        }

        return response()->json(['message' => 'Password reset request deleted successfully']);
    }
}
