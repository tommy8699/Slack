<?php

namespace AppUser\User\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use AppUser\User\Models\User;
use AppCore\Core\Classes\Custom\ApiResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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

    public function getGoogleRedirectUrl()
    {
        $redirectUrl = Socialite::driver('google')
            ->stateless()
            ->redirect()
            ->getTargetUrl();

        return ApiResponseHelper::jsonResponse(['url' => $redirectUrl]);
    }

    public function handleGoogleCallback()
    {
        try {
            // 1. Získať údaje od Googlu
            $googleUser = Socialite::driver('google')->stateless()->user();

            // 2. Získať alebo vytvoriť používateľa
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = new User();
                $user->name = $googleUser->getName();
                $user->email = $googleUser->getEmail();
                $user->password = Hash::make(Str::random(16));
            }

            // Prístupový token
            $accessToken = $googleUser->token;

            // 5. Vrátiť JSON odpoveď (alebo redirect späť do frontendu)
            return ApiResponseHelper::jsonResponse([
                'message' => 'Google login successful',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_token' => $accessToken,
                ]
            ]);
        } catch (\Exception $e) {
            return ApiResponseHelper::jsonResponse([
                'message' => 'Google login failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function googleLogin(Request $request)
    {
        $validated = $request->validate([
            'id_token' => 'required|string',
        ]);

        // Check token
        $googleResponse = Http::get('https://www.googleapis.com/oauth2/v3/userinfo', [
            'access_token' => $validated['id_token'],
        ]);

        if ($googleResponse->failed()) {
            throw new \Exception('Invalid Google token');
        }

        $googleUser = $googleResponse->json();

        $email = $googleUser['email'] ?? null;
        $name = $googleUser['name'] ?? 'Unknown';

        if (!$email) {
            throw new \Exception('Missing email in Google token');
        }

        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->password = Str::random(16);
        }

        // Vygeneruj nový token
        $plainToken = Str::random(15);
        $user->token = Hash::make($plainToken);
        $user->save();

        return ApiResponseHelper::jsonResponse([
            'token' => $user->token
        ], 200, 'Google login successful');
    }
}
