<?php

namespace AppChat\Chat\Models;

use Model;

class Chat extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'appchat_chat_chats';

    public $rules = [
        'name' => 'nullable|string|max:255',
    ];

    public $belongsToMany = [
        'users' => [
            \AppUser\User\Models\User::class,
            'table' => 'appchat_chat_chat_user',
            'pivot' => ['joined_at'],
            'timestamps' => true
        ]
    ];

    public $hasMany = [
        'messages' => [\AppChat\Chat\Models\Message::class]
    ];
}
