<?php

namespace AppChat\Chat;

use System\Classes\PluginBase;
use Illuminate\Support\Facades\Event;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Chat',
            'description' => 'Provides chat functionality via API and CMS.',
            'author'      => 'AppChat',
            'icon'        => 'icon-comments'
        ];
    }
}
