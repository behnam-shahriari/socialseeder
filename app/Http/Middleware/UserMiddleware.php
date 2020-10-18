<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware extends AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        return $this->handleRequest($request, $next, [
            'user',
            'client'
        ]);
    }
}
