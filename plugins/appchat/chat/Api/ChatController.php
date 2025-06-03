<?php

namespace AppChat\Chat\Api;

use AppChat\Chat\Models\Chat;
use AppUser\User\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->attributes->get('user');

        return $user->chats()->with('users')->get();
    }

    public function store(Request $request)
    {
        $user = $request->attributes->get('user');

        $chat = new Chat();
        $chat->name = $request->input('name');
        $chat->save();

        $chat->users()->attach($user->id, ['joined_at' => now()]);

        return $chat->load('users');
    }
}
