<?php

namespace Litepie\Team;

use Illuminate\Support\ServiceProvider;
use Litepie\Team\Providers\AuthServiceProvider;
use Litepie\Team\Providers\RouteServiceProvider;

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
        // Load view
        $this->loadViewsFrom(__DIR__.'/resources/views', 'team');

        // Load translation
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'team');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Call pblish redources function
        $this->publishResources();

        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'teams');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

            // Bind Team to repository
        $this->app->bind(
            'Litepie\Team\Interfaces\TeamRepositoryInterface',
            \Litepie\Team\Repositories\Eloquent\TeamRepository::class
        );

        $this->app->register(AuthServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['team'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__.'/config/config.php' => config_path('teams.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__.'/resources/views' => base_path('resources/views/vendor/team')], 'view');

        // Publish language files
        $this->publishes([__DIR__.'/resources/lang' => base_path('resources/lang/vendor/team')], 'lang');

        // Publish public files
        $this->publishes([__DIR__.'/public' => base_path('public')], 'public');
    }
}
