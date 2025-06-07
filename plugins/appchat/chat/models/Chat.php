<?php

namespace Appchat\Chat\Models;

use October\Rain\Database\Model;

/**
 * Chat Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Chat extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'appchat_chats';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $hasMany = [
        'messages' => [Message::class],
    ];

    public $belongsToMany = [
        'users' => [\AppUser\User\Models\User::class, 'table' => 'appchat_chat_user'],
    ];
}
