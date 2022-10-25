<?php

namespace Litepie\Activities;

use Spatie\Activitylog\ActivitylogServiceProvider;
use Spatie\Activitylog\CleanActivitylogCommand;

class ActivitiesServiceProvider extends ActivitylogServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('activitylog.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php',
            'activitylog'
        );
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('command.activities:clean', CleanActivitylogCommand::class);

        $this->commands([
            'command.activities:clean',
        ]);

    }

}
