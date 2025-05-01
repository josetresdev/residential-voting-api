<?php

namespace App\Services;

use App\Models\User;
use App\Models\Token;
use App\Utils\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class AuthService
{
    protected ApiResponse $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function register(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'uuid' => Str::uuid()->toString(),
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'apartment_number' => $data['apartment_number'] ?? null,
            ]);

            $token = JWTAuth::fromUser($user);

            Token::where('user_id', $user->id)->delete();

            Token::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => null,
            ]);

            return $this->apiResponse->success([
                'user' => $user,
                'token' => $token,
            ], 'Usuario registrado exitosamente.', 201);
        });
    }

    public function login(array $credentials)
    {
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->apiResponse->unauthorized('Credenciales incorrectas.');
            }

            $user = JWTAuth::user();

            Token::where('user_id', $user->id)->delete();

            Token::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => null,
            ]);

            return $this->apiResponse->success([
                'user' => $user,
                'token' => $token,
            ], 'Login exitoso.');

        } catch (JWTException $e) {
            return $this->apiResponse->serverError('Error al generar el token.');
        }
    }

    public function logout()
    {
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);

            Token::where('token', $token)->delete();

            return $this->apiResponse->success(null, 'Sesión cerrada correctamente.');

        } catch (\Exception $e) {
            return $this->apiResponse->serverError('Error al cerrar sesión: ' . $e->getMessage());
        }
    }

    public function getAuthenticatedUser()
    {
        try {
            $token = JWTAuth::parseToken()->getToken();

            if (!$token) {
                return $this->apiResponse->unauthorized('Token no proporcionado. Por favor, inicie sesión nuevamente.');
            }

            $storedToken = Token::where('token', $token)->first();

            if (!$storedToken) {
                return $this->apiResponse->unauthorized('Token no encontrado. Parece que no tienes una sesión activa.');
            }

            if (!is_null($storedToken->expires_at) && $storedToken->expires_at < now()) {
                return $this->apiResponse->unauthorized('Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
            }

            $user = JWTAuth::authenticate($token);

            if (!$user) {
                return $this->apiResponse->unauthorized('No pudimos autenticarte. Asegúrate de haber iniciado sesión correctamente.');
            }

            $user->load('roles.permissions');
            return $this->apiResponse->success($user);

        } catch (TokenExpiredException $e) {
            return $this->apiResponse->unauthorized('Tu sesión ha expirado. Por favor, inicia sesión nuevamente.');
        } catch (TokenInvalidException $e) {
            return $this->apiResponse->unauthorized('El token es inválido. Asegúrate de haber iniciado sesión correctamente.');
        } catch (TokenBlacklistedException $e) {
            return $this->apiResponse->unauthorized('Parece que tu sesión ha sido cerrada. Inicia sesión nuevamente.');
        } catch (JWTException $e) {
            return $this->apiResponse->unauthorized('No se ha proporcionado un token o el token es incorrecto.');
        } catch (\Exception $e) {
            return $this->apiResponse->unauthorized('Error al obtener usuario autenticado: ' . $e->getMessage());
        }
    }

    public function validateToken(string $token)
    {
        try {
            $storedToken = Token::where('token', $token)->first();

            if (!$storedToken) {
                throw new \Exception('Token no encontrado.');
            }

            if ($storedToken->expires_at !== null && $storedToken->expires_at < now()) {
                throw new \Exception('Token expirado.');
            }

            $user = JWTAuth::setToken($token)->authenticate();

            if (!$user) {
                throw new \Exception('Usuario no autenticado.');
            }

            return $user;
        } catch (TokenExpiredException $e) {
            throw new \Exception('Token expirado. Por favor inicie sesión nuevamente.');
        } catch (TokenInvalidException $e) {
            throw new \Exception('Token inválido.');
        } catch (JWTException $e) {
            throw new \Exception('Token no válido.');
        } catch (\Exception $e) {
            throw new \Exception('Error de autenticación: ' . $e->getMessage());
        }
    }
}
