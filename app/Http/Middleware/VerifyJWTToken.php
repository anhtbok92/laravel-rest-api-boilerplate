<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use JWTAuth;
use Symfony\Component\Console\Output\NullOutput;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class VerifyJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            JWTAuth::toUser(JWTAuth::getToken());
            return $next($request);
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json([
                    'code' => 2,
                    'message' => MSG_API_001,
                    'error' => new NullOutput(),
                    'data' => new NullOutput()
                ], 401);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'code' => 1,
                    'message' => MSG_API_002,
                    'error' => new NullOutput(),
                    'data' => new NullOutput()
                ], 401);
            }

            return response()->json([
                'code' => 403,
                'message' => MSG_API_003,
                'error' => new NullOutput(),
                'data' => new NullOutput()
            ], 403);
        }
    }
}
