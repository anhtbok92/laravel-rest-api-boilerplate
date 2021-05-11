<?php

namespace Modules\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DBTransactionMiddleware
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
        if ($request->method() != 'GET') {
            DB::beginTransaction();
            $response = $next($request);
            if ($response->getStatusCode() > 399) {
                DB::rollBack();
            } else {
                DB::commit();
            }

            return $response;
        }
        return $next($request);
    }
}
