<?php

namespace Modules\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        Log::info(json_encode([
            'URI' => $request->getUri(),
            'METHOD' => $request->getMethod(),
            'CLIENT_REQUESTS' => $request->all(),
            'RESPONSE' => json_decode($response->getContent())
        ]));
        return $response;
    }
}
