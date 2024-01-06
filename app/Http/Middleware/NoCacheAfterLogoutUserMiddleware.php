<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NoCacheAfterLogoutUserMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // If the user is not logged in with the 'web' guard, add no-cache headers
        if (!Auth::guard('web')->check()) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $response->header('Pragma', 'no-cache');
            $response->header('Expires', '0');
        }

        return $response;
    }
}