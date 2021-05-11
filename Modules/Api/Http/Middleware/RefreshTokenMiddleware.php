<?php

namespace Modules\Api\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\NullOutput;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use JWTAuth;

class RefreshTokenMiddleware
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
            $request->accessToken = JWTAuth::refresh(JWTAuth::getToken());
        } catch (Exception $e) {
            $code = 403;
            $message = MSG_API_003;
            $httpStatus = 403;
            if ($e instanceof TokenExpiredException) {
                $code = 1;
                $message = MSG_API_004;
                $httpStatus = 401;
            }

            if ($e instanceof TokenInvalidException) {
                $code = 2;
                $message = MSG_API_005;
                $httpStatus = 401;
            }

            return response()->json([
                'code' => $code,
                'message' => $message,
                'error' => new NullOutput(),
                'data' => new NullOutput()
            ], $httpStatus);
        }
        return $next($request);
    }
}
