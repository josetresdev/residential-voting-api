<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utils\ApiResponse;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'apartment_number' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors()->toArray());
        }

        try {
            return $this->authService->register($validator->validated());
        } catch (\Exception $e) {
            return ApiResponse::serverError('Error al registrar el usuario: ' . $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return ApiResponse::validationError($validator->errors()->toArray());
        }

        try {
            return $this->authService->login($validator->validated());
        } catch (\Exception $e) {
            return ApiResponse::serverError('Error al iniciar sesión: ' . $e->getMessage());
        }
    }

    public function logout()
    {
        try {
            return $this->authService->logout();
        } catch (\Exception $e) {
            return ApiResponse::serverError('Error al cerrar sesión: ' . $e->getMessage());
        }
    }

    public function user()
    {
        try {
            return $this->authService->getAuthenticatedUser();
        } catch (\Exception $e) {
            return ApiResponse::unauthorized('No autorizado: ' . $e->getMessage());
        }
    }
}
