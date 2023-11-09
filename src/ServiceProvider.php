<?php

namespace Gridonic\StatamicBoilerplateAddon;

use Gridonic\StatamicBoilerplateAddon\Listeners\SetRootAndDataFromOrigin;
use Gridonic\StatamicBoilerplateAddon\Listeners\UpdateCachedOriginOfDescendants;
use Gridonic\StatamicBoilerplateAddon\Tags\Boilerplate;
use Illuminate\Support\Facades\View;
use Statamic\Events\EntryCreated;
use Statamic\Events\EntrySaved;
use Statamic\Facades\GlobalSet;
use Statamic\Facades\Site;
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
        EntrySaved::class => [
            UpdateCachedOriginOfDescendants::class, // @see https://github.com/statamic/cms/issues/6714
        ]
    ];

    protected $routes = [
        'web' => __DIR__ . '/../routes/web.php',
    ];

    public function bootAddon()
    {
        Statamic::booted(function () {
            View::share('site', Site::current());
            $sets = GlobalSet::all();
            foreach ($sets as $set) {
                View::share($set->handle(), $set->inCurrentSite());
            }
        });

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
