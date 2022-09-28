<?php

namespace Litepie\Actions;

use Spatie\Activitylog\ActivitylogServiceProvider;

class ActionsServiceProvider extends ActivitylogServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('actions.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php',
            'actions'
        );
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->register(\Lorisleiva\Actions\ActionServiceProvider::class);
    }

}
