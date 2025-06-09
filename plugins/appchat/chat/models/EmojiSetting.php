<?php namespace Appchat\Chat\Models;

use Model;

/**
 * EmojiSetting Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class EmojiSetting extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'appchat_emoji_settings';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
