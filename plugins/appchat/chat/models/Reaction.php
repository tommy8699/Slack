<?php

namespace Appchat\Chat\Models;

use October\Rain\Database\Model;

/**
 * Reaction Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Reaction extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'appchat_reactions';

    /**
     * @var array rules for validation
     */
    public $rules = [
        'emoji' => 'required|string',
    ];

    public $belongsTo = [
        'message' => Message::class,
        'user' => \AppUser\User\Models\User::class,
    ];

    protected $fillable = [
        'user_id',
        'message_id',
        'emoji',
    ];
}
