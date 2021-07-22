<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKey
{
    private const KEY_NAME = 'integrator';
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header(self::KEY_NAME) === null) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}
