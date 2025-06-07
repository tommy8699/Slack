<?php

namespace Appchat\Chat\Models;

use System\Models\SettingModel;
use October\Rain\Database\Traits\Validation;

class EmojiSetting extends SettingModel
{
    use Validation;

    /**
     * Kód nastavení v databáze (v `system_settings`)
     */
    public $settingsCode = 'appchat_chat_emoji_settings';

    /**
     * Súbor s definíciou polí
     */
    public $settingsFields = 'fields.yaml';

    /**
     * Validačné pravidlá
     */
    public $rules = [
        'emojis' => 'required|string',
    ];

    /**
     * Polia ukladané ako JSON
     */
    protected $jsonable = ['emojis'];
}
