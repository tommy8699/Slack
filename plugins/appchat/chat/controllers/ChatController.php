<?php

namespace AppChat\Chat\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Chats extends Controller
{
    public $implement = ['Backend\Behaviors\ListController', 'Backend\Behaviors\FormController'];
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('AppChat.Chat', 'chat', 'chats');
    }
}
