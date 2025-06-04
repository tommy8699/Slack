<?php

use Illuminate\Support\Facades\Route;
use AppChat\Api\ChatController;
use AppChat\Api\MessageController;
use AppChat\Api\EmojiController;

Route::prefix('api')->group(function () {

    // Chats
    Route::middleware(['authToken'])->group(function () {
        Route::get('chats', [ChatController::class, 'index']);
        Route::post('chats', [ChatController::class, 'store']);
        Route::post('chats/{id}/rename', [ChatController::class, 'rename']);
        Route::post('chats/{id}/invite', [ChatController::class, 'invite']);
        Route::post('chats/{id}/leave', [ChatController::class, 'leave']);

        // Messages
        Route::get('chats/{id}/messages', [MessageController::class, 'index']);
        Route::post('chats/{id}/messages', [MessageController::class, 'store']);
        Route::post('messages/{id}/react', [MessageController::class, 'react']);
    });

    // Emojis - no auth required
    Route::get('emojis', [EmojiController::class, 'index']);
});
