<?php

namespace App\Http\Controllers;

use App\Services\PasswordResetService;
use Illuminate\Http\Request;
use App\Utils\ApiResponse;

class PasswordResetController extends Controller
{
    protected $passwordResetService;
    protected $apiResponse;

    public function __construct(PasswordResetService $passwordResetService, ApiResponse $apiResponse)
    {
        $this->passwordResetService = $passwordResetService;
        $this->apiResponse = $apiResponse;
    }

    public function index()
    {
        return $this->passwordResetService->index();
    }

    public function store(Request $request)
    {
        // Validar datos
        $data = $request->validate([
            'email' => 'required|email',
        ]);

        return $this->passwordResetService->store($data);
    }

    public function show(string $id)
    {
        return $this->passwordResetService->show((int) $id);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
        ]);

        return $this->passwordResetService->update((int) $id, $data);
    }

    public function destroy(string $id)
    {
        return $this->passwordResetService->destroy((int) $id);
    }
}
