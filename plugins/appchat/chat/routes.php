<?php

use AppChat\Chat\Api\ChatController;
use AppChat\Chat\Api\EmojiController;
use AppChat\Chat\Api\MessageController;
use Illuminate\Support\Facades\Route;

// API routy chránené middleware-om 'auth.user' s prefixom api/v1
Route::prefix('api/v1')->group(function () {

    Route::middleware(['AppUser\User\Middleware\Authenticate'])->group(function () {

        // Chaty
        Route::get('/chats', [ChatController::class, 'index']);
        Route::post('/chats', [ChatController::class, 'store']);
        Route::put('/chats/{id}/rename', [ChatController::class, 'rename']);
        Route::post('/chats/{id}/invite', [ChatController::class, 'invite']);
        Route::post('/chats/{id}/leave', [ChatController::class, 'leave']);

        // Správy
        Route::get('/chats/{id}/messages', [MessageController::class, 'index']);
        Route::post('/chats/{id}/messages', [MessageController::class, 'store']);
        Route::post('/messages/{id}/react', [MessageController::class, 'react']);

    });

    // Emoji (bez autentifikácie)
    Route::get('/emojis', [EmojiController::class, 'index']);
});
