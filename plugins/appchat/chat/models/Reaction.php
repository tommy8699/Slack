<?php

namespace AppChat\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\AttachMany;

class Reaction extends Model
{
    use Validation;

    public $table = 'appchat_reactions';

    public $rules = [
        'emoji' => 'required|string',
    ];

    public $belongsTo = [
        'message' => Message::class,
        'user' => \AppUser\Models\User::class,
    ];
}
