<?php

namespace AppUser\User\Http\Controllers;

use AppUser\User\Http\Resources\ApiResponseHelper;
use AppUser\User\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    use \Illuminate\Auth\Authenticatable;

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
        $user->token = bin2hex(random_bytes(30));
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

        $user = User::all()->where('email', $validated['email'])->first();

        if(!$user) {
            \Log::warning('Používateľ neexistuje');
            throw new \Exception('User not found');
        }
        elseif (!Hash::check($validated['password'], $user->password)) {
            \Log::warning('Nesprávne heslo pre používateľa: ' . $user->email);
            throw new \Exception('Nesprávne heslo pre používateľa: ' . $user->email);
        }

        $user->token = bin2hex(random_bytes(15));
        $user->save();

        return ApiResponseHelper::jsonResponse([
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

        return ApiResponseHelper::jsonResponse([
            'message' => 'Logged out'
        ]);
    }
}
