<?php

namespace AppChat\Chat;

use Backend\Facades\Backend;
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

    public function registerNavigation()
    {
        return [
            'emoji_settings' => [
                'label'       => 'Nastavenia emoji',
                'icon'        => 'icon-cogs',
                'url'         => Backend::url('appchat/chat/emojisetting'),
                'permissions' => ['appchat.chat.access_emoji_settings'],
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'appchat.chat.access_emoji_settings' => [
                'tab'   => 'Chat',
                'label' => 'Spravovať nastavenia emoji',
            ],
        ];
    }
}
