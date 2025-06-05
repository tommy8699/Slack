<?php

namespace AppUser\Middleware;

use AppUser\User\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $matches[1];

        $user = User::where('token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Pridáme usera do requestu, aby bol dostupný v kontroléroch
        $request->merge(['auth_user' => $user]);

        return $next($request);
    }
}
