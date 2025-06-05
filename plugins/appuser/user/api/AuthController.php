<?php

namespace AppUser\User\Api;

use AppUser\User\helpers\ApiResponseHelper;
use AppUser\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

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
        $user->password = Hash::make($validated['password']);
        $user->token = bin2hex(random_bytes(15));         // 30 znakov
        $user->persist_code = bin2hex(random_bytes(10));  // 20 znakov
        $user->save();

        return ApiResponseHelper::jsonResponse([
            'token' => $user->token
        ], 201, 'User registered');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();

        \Log::info('Pokús o prihlásenie: ' . $validated['email']);

        if (!$user) {
            \Log::warning('Používateľ neexistuje');
        } elseif (!Hash::check($validated['password'], $user->password)) {
            \Log::warning('Nesprávne heslo pre používateľa: ' . $user->email);
        }

        return ApiResponseHelper::jsonResponse([
            'token' => $user->token
        ], 200, 'Login successful');
    }

    public function logout(Request $request)
    {
        $user = $request->user;

        if ($user) {
            $user->token = null;
            $user->persist_code = null;
            $user->save();
        }

        return ApiResponseHelper::jsonResponse([
            'message' => 'Logged out'
        ]);
    }
}
