<?php

namespace AppChat\Chat\Http\Controllers;

use AppCore\Core\Classes\Custom\ApiResponseHelper;
use AppChat\Chat\Models\Chat;
use AppChat\Chat\Models\Message;
use AppChat\Chat\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use AppUser\User\Models\User;

class MessageController extends BaseController
{
    public function index(Request $request, $chatId)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return ApiResponseHelper::jsonResponse(['error' => 'Token missing'], 401, 'Unauthenticated');
        }

        $user = User::where('token', $token)->first(); // alebo decode JWT
        if (!$user) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthenticated'], 401, 'Unauthenticated');
        }

        $chat = Chat::findOrFail($chatId);

        if (!$chat->users->contains($user->id)) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthorized'], 403, 'Unauthorized');
        }

        $messages = $chat->messages()->with(['user', 'reactions'])->latest()->get();

        return ApiResponseHelper::jsonResponse($messages);
    }

    public function store(Request $request, $chatId)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return ApiResponseHelper::jsonResponse(['error' => 'Token missing'], 401, 'Unauthenticated');
        }

        $user = User::where('token', $token)
            ->first(); // alebo decode JWT

        if (!$user) {
            return ApiResponseHelper::jsonResponse(['error' => 'Invalid token'], 401, 'Unauthenticated');
        }

        $chat = Chat::findOrFail($chatId);

        if (!$chat->users->contains($user->id)) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthorized'], 403, 'Unauthorized');
        }

        $message = new Message;
        $message->chat_id = $chat->id;
        $message->user_id = $user->id;
        $message->content = $request->get('content');
        $message->parent_id = $request->get('reply_to_id');
        $message->save();

        if ($request->hasFile('attachment')) {
            $message->attachment = $request->file('attachment');
            $message->save();
        }

        return ApiResponseHelper::jsonResponse($message);
    }

    public function react(Request $request, $messageId)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return ApiResponseHelper::jsonResponse(['error' => 'Token missing'], 401, 'Unauthenticated');
        }

        $user = User::where('token', $token)
            ->first(); // alebo tvoje overenie JWT

        if (!$user) {
            return ApiResponseHelper::jsonResponse(['error' => 'Invalid token'], 401, 'Unauthenticated');
        }

        $message = Message::findOrFail($messageId);

        if (!$message->chat->users->contains($user->id)) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthorized'], 403, 'Unauthorized');
        }

        $reaction = Reaction::firstOrNew([
            'user_id' => $user->id,
            'message_id' => $message->id,
        ]);

        $reaction->emoji = $request->get('emoji');
        $reaction->save();

        return ApiResponseHelper::jsonResponse($reaction);
    }
}
