<?php

use Illuminate\Support\Facades\Route;
use AppUser\User\Api\AuthController;

Route::prefix('api/v1/user')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware(\AppUser\User\Middleware\Authenticate::class);
});
