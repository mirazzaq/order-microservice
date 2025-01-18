<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $allowedSecrets = explode(',', env('ALLOWED_SECRETS'));
        if (in_array($request->header('Authorization'), $allowedSecrets)) {
            return $next($request);
        }
        abort(Response::HTTP_UNAUTHORIZED);
    }
}
