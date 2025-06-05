<?php

namespace AppChat\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\AttachMany;

class Message extends Model
{
    use Validation, AttachMany;

    public $table = 'appchat_messages';

    public $rules = [
        'content' => 'nullable|string',
        'chat_id' => 'required|exists:appchat_chats,id',
        'user_id' => 'required|exists:appuser_user_users,id', // opravený názov tabuľky
    ];

    public $belongsTo = [
        'chat' => Chat::class,
        'user' => \AppUser\User\Models\User::class,
        'replyTo' => [self::class, 'key' => 'parent_id'], // opravený kľúč podľa migrácie
    ];

    public $hasMany = [
        'reactions' => [Reaction::class],
    ];

    public $attachMany = [
        'files' => ['System\Models\File'],
    ];
}
