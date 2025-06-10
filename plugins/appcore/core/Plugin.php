<?php namespace AppCore\Core;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Core',
            'description' => 'Provides core utilities, enums, and shared classes used across multiple application plugins.',
            'author' => 'AppCore',
            'icon' => 'icon-leaf'
        ];
    }
}
