<?php

use Illuminate\Support\Facades\Route;
use AppChat\Chat\Api\ChatController;
use AppChat\Chat\Api\MessageController;
use AppChat\Chat\Api\ReactionController;
use AppChat\Chat\Api\EmojiController;

// Chránené routy - vyžadujú autentifikáciu
Route::group(['prefix' => 'api/chat', 'middleware' => ['AppUser\User\Classes\ApiAuthMiddleware']], function () {

    // Chaty
    Route::get('chats', [ChatController::class, 'index']);         // Zoznam chatov prihláseného používateľa
    Route::post('chats', [ChatController::class, 'store']);        // Vytvorenie nového chatu
    Route::put('chats/{id}', [ChatController::class, 'update']);   // Zmena názvu chatu
    Route::post('chats/{id}/invite', [ChatController::class, 'invite']); // Pozvanie používateľa do chatu
    Route::post('chats/{id}/leave', [ChatController::class, 'leave']);   // Odchod z chatu

    // Správy
    Route::get('chats/{chatId}/messages', [MessageController::class, 'index']);     // Získanie správ v chate
    Route::post('chats/{chatId}/messages', [MessageController::class, 'store']);    // Odoslanie správy
    Route::delete('messages/{id}', [MessageController::class, 'destroy']);          // Vymazanie správy

    // Reakcie
    Route::post('messages/{id}/reaction', [ReactionController::class, 'react']);    // Reagovanie na správu
    Route::delete('messages/{id}/reaction', [ReactionController::class, 'remove']); // Odstránenie reakcie

    // Emojis - nastavené v CMS Settings
    Route::get('emojis', [EmojiController::class, 'index']); // Zoznam dostupných emojis z nastavení
});
