<?php

namespace AppChat\Chat\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class Reaction extends Model
{
    use Validation;

    public $table = 'appchat_reactions';

    public $rules = [
        'emoji' => 'required|string',
    ];

    public $belongsTo = [
        'message' => Message::class,
        'user' => \AppUser\User\Models\User::class,
    ];
}
