<?php

namespace AppChat\Api;

use AppChat\Helpers\ApiResponseHelper;
use AppChat\Models\Chat;
use AppChat\Models\Message;
use AppChat\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class MessageController extends BaseController
{
    public function send(Request $request, $chatId)
    {
        $chat = Chat::findOrFail($chatId);
        if (!$chat->users->contains($request->user()->id)) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthorized'], 403, 'Unauthorized');
        }
        $message = new Message;
        $message->chat_id = $chat->id;
        $message->user_id = $request->user()->id;
        $message->content = $request->get('content');
        $message->reply_to_id = $request->get('reply_to_id');
        $message->save();

        if ($request->hasFile('attachment')) {
            $message->attachment = $request->file('attachment');
            $message->save();
        }

        return ApiResponseHelper::jsonResponse($message);
    }

    public function react(Request $request, $messageId)
    {
        $message = Message::findOrFail($messageId);
        if (!$message->chat->users->contains($request->user()->id)) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthorized'], 403, 'Unauthorized');
        }
        $reaction = Reaction::firstOrNew([
            'user_id' => $request->user()->id,
            'message_id' => $message->id,
        ]);
        $reaction->emoji = $request->get('emoji');
        $reaction->save();

        return ApiResponseHelper::jsonResponse($reaction);
    }
}
