<?php

namespace AppChat\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\AttachMany;

class Message extends Model
{
    use Validation, AttachMany;

    public $table = 'appchat_messages';

    public $rules = [
        'content' => 'nullable|string',
        'chat_id' => 'required|exists:appchat_chats,id',
        'user_id' => 'required|exists:appuser_users,id'
    ];

    public $belongsTo = [
        'chat' => Chat::class,
        'user' => \AppUser\Models\User::class,
        'replyTo' => [self::class, 'key' => 'reply_id']
    ];

    public $hasMany = [
        'reactions' => [Reaction::class],
    ];

    public $attachMany = [
        'files' => 'System\Models\File',
    ];
}
