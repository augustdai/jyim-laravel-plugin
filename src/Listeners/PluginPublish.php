<?php

namespace Jyim\LaravelPlugin\Listeners;

use Illuminate\Support\Facades\Artisan;
use Jyim\LaravelPlugin\Support\Plugin;

class PluginPublish
{
    public function handle(Plugin $plugin)
    {
        Artisan::call('plugin:publish', ['plugin' => $plugin->getName()]);
    }
}
