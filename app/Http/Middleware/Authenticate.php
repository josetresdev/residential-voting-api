<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();

            return $next($request);
        } catch (TokenBlacklistedException $e) {
            return response()->json([
                'message' => 'The token has been blacklisted',
                'exception' => get_class($e)
            ], 401);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'message' => 'The token has expired',
                'exception' => get_class($e)
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'message' => 'The token is invalid',
                'exception' => get_class($e)
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'The token is not present or malformed',
                'exception' => get_class($e)
            ], 401);
        }
    }
}
