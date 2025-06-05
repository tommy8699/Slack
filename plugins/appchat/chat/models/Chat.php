<?php

namespace AppChat\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class Chat extends Model
{
    use Validation;

    public $table = 'appchat_chats';

    public $rules = [
        'name' => 'required|string|max:255',
    ];

    public $hasMany = [
        'messages' => [Message::class],
    ];

    public $belongsToMany = [
        'users' => [\AppUser\User\Models\User::class, 'table' => 'appchat_chat_user'],
    ];
}
