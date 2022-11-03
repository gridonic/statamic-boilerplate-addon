<?php

namespace Gridonic\StatamicBoilerplateAddon;

use Gridonic\StatamicBoilerplateAddon\Listeners\SetRootAndDataFromOrigin;
use Gridonic\StatamicBoilerplateAddon\Tags\Boilerplate;
use Statamic\Events\EntryCreated;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    const CONFIG_TAG = 'statamic-boilerplate-addon-config';

    protected $tags = [
        Boilerplate::class
    ];

    protected $listen = [
        EntryCreated::class => [
            SetRootAndDataFromOrigin::class,
        ],
    ];

    protected $routes = [
        'web' => __DIR__ . '/../routes/web.php',
    ];

    public function bootAddon()
    {
        $this->publishConfig();
        Statamic::afterInstalled(function ($command) {
            $command->call('vendor:publish', [
                '--tag' => self::CONFIG_TAG,
            ]);
        });

    }

    private function publishConfig()
    {
        if ($this->app->runningInConsole()) {
            $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'statamic.boilerplate');
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('statamic/boilerplate.php'),
            ], self::CONFIG_TAG);
        }
    }
}
