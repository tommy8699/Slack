<?php

namespace AppChat\Chat;

use AppChat\Chat\Classes\RoutesServiceProvider;
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

    public function register()
    {
        // Registrácia eventov, ak bude potrebná
    }

    public function boot()
    {
        // Načítanie rout pre API
        \App::register(RoutesServiceProvider::class);
    }
}
