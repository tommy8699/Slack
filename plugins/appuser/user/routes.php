<?php

use Illuminate\Support\Facades\Route;
use AppUser\User\Http\Controllers\AuthController;

Route::prefix('api/v1/user')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(\AppUser\User\Middleware\Authenticate::class);

    # Google login #
    Route::get('google/url', [AuthController::class, 'getGoogleRedirectUrl']);
    Route::get('google/callback', [AuthController::class, 'handleGoogleCallback']);
    Route::post('google', [AuthController::class, 'googleLogin']);
});
