<?php

namespace App\Http\Middleware;

use Closure;

class ClientMiddleware extends AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
