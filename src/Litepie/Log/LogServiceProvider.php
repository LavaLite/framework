<?php

namespace Litepie\Log;

use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();

    }

    /**
     * Merges user's and log's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {

        $this->mergeConfigFrom(
            __DIR__ . '/config/activity.php', 'activitylog'
        );
    }
}
