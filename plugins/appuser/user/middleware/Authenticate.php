<?php

namespace AppUser\User\Middleware;

use AppUser\User\Models\User;

class Authenticate
{
    public function handle($request, \Closure $next)
    {
        $token = $request->bearerToken();

        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Priradí používateľa do request objektu
        $request->user = $user;

        return $next($request);
    }
}
