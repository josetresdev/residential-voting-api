<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            $previous = $exception->getPrevious();

            if ($previous instanceof TokenBlacklistedException) {
                return response()->json([
                    'message' => 'Token en lista negra. Por favor, inicia sesión nuevamente.',
                ], 401);
            }

            if ($previous instanceof TokenExpiredException) {
                return response()->json([
                    'message' => 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.',
                ], 401);
            }

            if ($previous instanceof TokenInvalidException) {
                return response()->json([
                    'message' => 'El token es inválido. Asegúrate de iniciar sesión correctamente.',
                ], 401);
            }

            if ($previous instanceof JWTException) {
                return response()->json([
                    'message' => 'No se ha proporcionado un token o es inválido.',
                ], 401);
            }

            return response()->json([
                'message' => 'No autorizado.',
            ], 401);
        }

        if ($exception instanceof TokenExpiredException) {
            return response()->json([
                'message' => 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.',
            ], 401);
        }

        if ($exception instanceof TokenInvalidException) {
            return response()->json([
                'message' => 'Token inválido.',
            ], 401);
        }

        if ($exception instanceof TokenBlacklistedException) {
            return response()->json([
                'message' => 'Token en lista negra. Inicia sesión nuevamente.',
            ], 401);
        }

        if ($exception instanceof JWTException) {
            return response()->json([
                'message' => 'Error al procesar el token.',
            ], 401);
        }

        if ($exception instanceof AuthenticationException) {
            return response()->json([
                'message' => 'No autorizado.',
            ], 401);
        }

        if ($exception instanceof HttpException) {
            return response()->json([
                'message' => 'Error de solicitud: ' . $exception->getMessage(),
            ], $exception->getStatusCode());
        }

        return parent::render($request, $exception);
    }
}
