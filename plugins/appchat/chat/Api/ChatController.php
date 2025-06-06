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
        $validated = $request->validate([
            'name' => 'nullable|string|max:255'
        ]);

        $chat = new Chat();
        $chat->name = $validated['name'] ?? 'New Chat';
        $chat->save();

        // Pridá aktuálneho používateľa do chatu
        $chat->users()->attach($request->user->id);

        return ApiResponseHelper::jsonResponse($chat, 201, 'Chat created');
    }

    public function rename(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $chat->name = $request->get('name');
        $chat->save();

        return ApiResponseHelper::jsonResponse($chat, 200, 'Chat renamed');
    }

    public function invite(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        $user = $request->user;

        // SQL dotaz: overí, či používateľ patrí do chatu
        $hasAccess = $chat->users()
            ->where('appuser_user_users.id', $user->id)
            ->exists();

        if (!$hasAccess) {
            return ApiResponseHelper::jsonResponse(['error' => 'Unauthorized'], 403, 'Unauthorized');
        }

        // Validácia vstupu
        $validated = $request->validate([
            'user_id' => 'required|exists:appuser_user_users,id'
        ]);

        // Zabráni duplikátom
        $chat->users()->syncWithoutDetaching([$validated['user_id']]);

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
