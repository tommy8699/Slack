<?php

namespace AppChat;

use System\Classes\PluginBase;
use AppChat\Models\EmojiSetting;
use Event;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'AppChat',
            'description' => 'Chat backend with messages, reactions, emojis and API.',
            'author'      => 'App',
            'icon'        => 'icon-comments'
        ];
    }

    public function registerSettings()
    {
        return [
            'emojisetting' => [
                'label'       => 'Emoji Settings',
                'description' => 'Manage available emojis for reactions.',
                'category'    => 'Chat',
                'icon'        => 'icon-smile-o',
                'class'       => EmojiSetting::class,
                'order'       => 500,
                'keywords'    => 'emoji chat reaction',
                'permissions' => ['appchat.manage_emojis']
            ]
        ];
    }
}
