<?php

use Model;
use October\Rain\Database\Traits\Validation;
use October\Rain\Database\Traits\SoftDelete;
use October\Rain\Database\Traits\AttachMany;

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
