<?php

namespace AppChat\Chat\Classes;

use Illuminate\Support\ServiceProvider;

class RoutesServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Načítanie API rout
        require_once base_path('plugins/appchat/chat/routes.php');
    }

    public function register()
    {
        // Ak by bolo treba registrovať ďalšie veci neskôr
    }
}
