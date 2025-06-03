<?php

namespace AppUser\User\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use AppUser\User\Models\User;
use Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->only(['email', 'password', 'name']);
        $user = User::create($data);

        return response()->json(['token' => $user->token], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['token' => $user->token]);
    }

    public function logout(Request $request)
    {
        $user = $request->user;
        $user->token = null;
        $user->save();

        return response()->json(['message' => 'Logged out']);
    }
}
