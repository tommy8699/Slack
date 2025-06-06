<?php

namespace Appchat\Chat\Models;

use Model;

/**
 * Message Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Message extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'appchat_messages';

    /**
     * @var array rules for validation
     */
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
