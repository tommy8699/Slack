<?php

namespace AppChat\Chat\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class EmojiSetting extends Model
{
    use Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'appchat_emojis';
    public $settingsFields = 'fields.yaml';

    public $table = 'appchat_emoji_settings';

    public $rules = [
        'emojis' => 'required|array',
    ];

    protected $jsonable = ['emojis'];
}
