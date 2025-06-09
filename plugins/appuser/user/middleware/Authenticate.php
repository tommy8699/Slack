<?php

namespace AppUser\User\Middleware;

use AppUser\User\Models\User;
use WApi\ApiException\Exceptions\WUnauthorizedException;
use function PHPUnit\Framework\throwException;

class Authenticate
{
    public function handle($request, \Closure $next)
    {
        $token = $request->bearerToken();

        $user = User::query()
            ->whereNotNull('token')
            ->where('token', $token)
            ->first();

        if (!$user || !$token) {
            throw new WUnauthorizedException('Unauthenticated');
        }

        // Priradí používateľa do request objektu
        $request->user = $user;

        return $next($request);
    }
}
