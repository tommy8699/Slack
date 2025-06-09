<?php

namespace AppUser\User\Http\Controllers;

use AppUser\User\Http\Resources\ApiResponseResource;
use AppUser\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:appuser_user_users,email',
            'password' => 'required|min:6',
            'name' => 'required|string',
        ]);

        $user = new User();
        $user->email = $validated['email'];
        $user->name = $validated['name'];
        $user->password = $validated['password'];
        $user->save();

        return ApiResponseResource::jsonResponse([
            'token' => $user->token
        ], 201, 'User registered');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::query()->where('email', $validated['email'])->first();

        if(!$user) {
            \Log::warning('Používateľ neexistuje');
            throw new \Exception('User not found');
        }
        elseif (!Hash::check($validated['password'], $user->password)) {
            \Log::warning('Nesprávne heslo pre používateľa: ' . $user->email);
            throw new \Exception('Nesprávne heslo pre používateľa: ' . $user->email);
        }

        $plainToken = Str::random(15);
        $user->token = Hash::make($plainToken);
        $user->save();

        return ApiResponseResource::jsonResponse([
            'token' => $user->token
        ], 200, 'Login successful');
    }

    public function logout(Request $request)
    {
        $user = $request->user;

        if ($user) {
            $user->token = '';
            $user->save();
        }

        return ApiResponseResource::jsonResponse([
            'message' => 'Logged out'
        ]);
    }
}
