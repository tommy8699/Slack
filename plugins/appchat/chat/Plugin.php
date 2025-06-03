<?php

namespace AppChat\Chat;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Chat',
            'description' => 'Konverzácie medzi používateľmi',
            'author'      => 'AppChat',
            'icon'        => 'icon-comments'
        ];
    }
}
