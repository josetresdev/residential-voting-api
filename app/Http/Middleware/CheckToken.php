<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\AuthService;

class CheckToken
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
    
        if (!$token) {
            return response()->json(['error' => 'Token no proporcionado.'], 401);
        }
    
        try {
            $user = $this->authService->validateToken($token);
            $request->merge(['user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token inválido o expirado. Detalles: ' . $e->getMessage()], 401);
        }
    
        return $next($request);
    }
}
