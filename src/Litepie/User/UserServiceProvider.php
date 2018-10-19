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
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'users');

        // Bind facade
        $this->app->bind('user', function ($app) {
            return $this->app->make('Litepie\User\User');
        });

        // Bind User to repository
        $this->app->bind(
            'Litepie\User\Interfaces\UserRepositoryInterface',
            \Litepie\User\Repositories\Eloquent\UserRepository::class
        );

        // Bind User to repository
        $this->app->bind(
            'Litepie\User\Interfaces\ClientRepositoryInterface',
            \Litepie\User\Repositories\Eloquent\ClientRepository::class
        );

        // Bind Team to repository
        $this->app->bind(
            'Litepie\User\Interfaces\TeamRepositoryInterface',
            \Litepie\User\Repositories\Eloquent\TeamRepository::class
        );

        $this->app->register(\Litepie\User\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\User\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\User\Providers\RouteServiceProvider::class);
        $this->app->register(\Laravel\Socialite\SocialiteServiceProvider::class);
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
