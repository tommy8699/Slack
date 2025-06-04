<?php

namespace AppChat\Api;

use AppChat\Models\Chat;
use AppUser\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use October\Rain\Extension\Controller;
use Illuminate\Routing\Controller as BaseController;

class ChatController extends BaseController
{
    public function create(Request $request)
    {
        $data = $request->only(['name']);
        $chat = new Chat;
        $chat->name = $data['name'] ?? 'New Chat';
        $chat->save();

        $chat->users()->attach($request->user()->id);
        return response()->json($chat);
    }

    public function rename(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        if (!$chat->users->contains($request->user()->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $chat->name = $request->get('name');
        $chat->save();
        return response()->json($chat);
    }

    public function invite(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        if (!$chat->users->contains($request->user()->id)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $userId = $request->get('user_id');
        $chat->users()->attach($userId);
        return response()->json(['status' => 'User invited']);
    }

    public function leave(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        $chat->users()->detach($request->user()->id);
        if ($chat->users()->count() === 0) {
            $chat->delete();
        }
        return response()->json(['status' => 'Left chat']);
    }
}
