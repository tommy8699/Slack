<?php

namespace AppUser\User\Middleware;

use Closure;
use AppUser\User\Models\User;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token || !User::where('token', $token)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->user = User::where('token', $token)->first();

        return $next($request);
    }
}
