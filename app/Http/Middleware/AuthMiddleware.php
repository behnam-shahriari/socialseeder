<?php

namespace App\Http\Middleware;

use App\Models\Actor;
use App\Traits\HttpResponse;
use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthMiddleware
{

    use HttpResponse;

    private $refreshToken = null;

    public function handleRequest($request, Closure $next, array $accessList)
    {

        if ($user = $this->authenticated()) {

            if ($this->authorized($user, $accessList)) {
                return $next($request);

            } else {
                return $this->unauthorized();
            }
        } else {
            return $this->unauthenticated();
        }
    }

    private function authenticated(): ?Authenticatable
    {
        if (Auth::user()) {
            return Auth::user();
        }
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return null;
            }
        } catch (JWTException $e) {
            return null;
        }
        Auth::login($user, false);
        return $user;
    }

    private function authorized(?Actor $user = null, array $accessList = []): bool
    {
        if (!isset($user)) {
            return false;
        }
        return isset($user) && in_array($user->permission, $accessList);
    }
}
