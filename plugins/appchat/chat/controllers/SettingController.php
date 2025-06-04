<?php

namespace AppChat\Controllers;

use Backend\Classes\Controller;
use System\Classes\SettingsManager;

class SettingController extends Controller
{
public $implement = [
'Backend\Behaviors\FormController'
];

public $formConfig = 'config_form.yaml';

public function __construct()
{
parent::__construct();
SettingsManager::setContext('AppChat', 'emojisettings');
}
}
