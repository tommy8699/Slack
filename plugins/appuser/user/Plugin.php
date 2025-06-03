<?php

namespace AppUser\User;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'User',
            'description' => 'Provides user authentication for the Slack app',
            'author' => 'AppUser',
            'icon' => 'icon-user'
        ];
    }
}
