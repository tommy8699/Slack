<?php

namespace AppChat\Chat\Api;

use AppChat\Chat\Helpers\ApiResponseHelper;
use AppChat\Chat\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ChatController extends BaseController
{

    public function index(Request $request)
    {
        $user = $request->user;

        $chats = Chat::whereHas('users', function ($query) use ($user) {
            $query->where('appuser_user_users.id', $user->id);
        })->get();

        return ApiResponseHelper::jsonResponse($chats);
    }

    public function store(Request $request)
    {
        $data = $request->only(['name']);
        $chat = new Chat;
        $chat->name = $data['name'] ?? 'New Chat';
        $chat->save();

        $chat->users()->attach($request->user()->id);
        return ApiResponseHelper::jsonResponse($chat);
    }

    public function rename(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        if (!$chat->users->contains($request->user()->id)) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthorized'], 403, 'Unauthorized');
        }
        $chat->name = $request->get('name');
        $chat->save();
        return ApiResponseHelper::jsonResponse($chat);
    }

    public function invite(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        if (!$chat->users->contains($request->user()->id)) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthorized'], 403, 'Unauthorized');
        }
        $userId = $request->get('user_id');
        $chat->users()->attach($userId);
        return ApiResponseHelper::jsonResponse(['status' => 'User invited']);
    }

    public function leave(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        $chat->users()->detach($request->user()->id);
        if ($chat->users()->count() === 0) {
            $chat->delete();
        }
        return ApiResponseHelper::jsonResponse(['status' => 'Left chat']);
    }
}
