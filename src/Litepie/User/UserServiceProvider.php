<?php

namespace Litepie\User;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'user');

        // Load translation
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'user');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Call pblish redources function
        $this->publishResources();

        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'users');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['user'];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind facade
        $this->app->bind('user', function ($app) {
            return $this->app->make('Litepie\User\User');
        });
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__.'/config/config.php' => config_path('users.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__.'/resources/views' => base_path('resources/views/vendor/user')], 'view');

        // Publish language files
        $this->publishes([__DIR__.'/resources/lang' => base_path('resources/lang/vendor/user')], 'lang');

        // Publish public files
        $this->publishes([__DIR__.'/public' => base_path('public')], 'public');
    }
}
