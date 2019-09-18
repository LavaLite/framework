<?php

namespace Litepie\Team;

/*
 * This file is part of Team
 *
 */

use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Publish Team configuration.
     */
    protected function publishConfig()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('team.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
        $this->registerTeam();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    protected function registerTeam()
    {
        $this->app->bind('team', function ($app) {
            return new Team($app);
        });
    }


    /**
     * Merges user's and teams's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'team'
        );
    }

}
