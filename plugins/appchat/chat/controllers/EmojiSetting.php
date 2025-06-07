<?php

namespace Appchat\Chat\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Emoji Setting Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class EmojiSetting extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['appchat.chat.access_emoji_settings'];

    /**
     * Kód nastavení v databáze (v `system_settings`)
     */
    public $settingsCode = 'appchat_emoji_settings';

    /**
     * Súbor s definíciou polí
     */
    public $settingsFields = 'fields.yaml';


    /**
     * Validačné pravidlá
     */
    public $rules = [
        'emojis' => 'required|array',
    ];

    /**
     * Polia ukladané ako JSON
     */
    protected $jsonable = ['emojis'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Appchat.Chat', 'chat', 'emojisetting');
    }
}
