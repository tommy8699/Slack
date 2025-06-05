<?php

namespace AppUser\User\Api;

use AppUser\User\helpers\ApiResponseHelper;
use AppUser\User\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->only(['email', 'password', 'name']);
        $user = User::create($data);

        return ApiResponseHelper::jsonResponse(['token' => $user->token], 201, 'User registered');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return ApiResponseHelper::jsonResponse(['error' => 'Invalid credentials'], 401, 'Authentication failed');
        }

        return ApiResponseHelper::jsonResponse(['token' => $user->token], 200, 'Login successful');
    }

    public function logout(Request $request)
    {
        $user = $request->user;
        $user->token = null;
        $user->save();

        return ApiResponseHelper::jsonResponse(['message' => 'Logged out']);
    }
}
