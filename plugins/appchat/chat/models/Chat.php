<?php


namespace AppChat\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\AttachMany;

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
        'users' => [\AppUser\Models\User::class, 'table' => 'appchat_chat_user'],
    ];
}
