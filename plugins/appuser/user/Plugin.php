<?php

namespace AppUser\User;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'AppUser',
            'description' => 'User authentication and management',
            'author'      => 'App',
            'icon'        => 'icon-user'
        ];
    }

}
