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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'vuser');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'user');

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
        // Bind facade
        $this->app->bind('user', function ($app) {
            return $this->app->make('Litepie\User\User');
        });

        // Bind User to repository
        $this->app->bind(
            \Litepie\User\Interfaces\UserRepositoryInterface::class,
            \Litepie\User\Repositories\Eloquent\UserRepository::class
        );
        // Bind Permission to repository
        $this->app->bind(
            \Litepie\User\Interfaces\PermissionRepositoryInterface::class,
            \Litepie\User\Repositories\Eloquent\PermissionRepository::class
        );
        // Bind Role to repository
        $this->app->bind(
            \Litepie\User\Interfaces\RoleRepositoryInterface::class,
            \Litepie\User\Repositories\Eloquent\RoleRepository::class
        );
        // Bind Team to repository
        $this->app->bind(
            \Litepie\User\Interfaces\TeamRepositoryInterface::class,
            \Litepie\User\Repositories\Eloquent\TeamRepository::class
        );

        $this->app->register(\Litepie\User\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\User\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\User\Providers\RouteServiceProvider::class);
        $this->app->register(\Litepie\User\Providers\WorkflowServiceProvider::class);
        $this->app->register(\Laravel\Socialite\SocialiteServiceProvider::class);
        $this->app->register(\Greggilbert\Recaptcha\RecaptchaServiceProvider::class);
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
        $this->publishes([__DIR__ . '/config/config.php' => config_path('litepie/user.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/user')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/user')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/database/seeds/' => base_path('database/seeds')], 'seeds');

        // Publish models
        $this->publishes([__DIR__ . '/database/models/' => base_path('/')], 'models');

        $this->publishes([__DIR__ . '/public' => base_path('public')], 'public');
    }
}
