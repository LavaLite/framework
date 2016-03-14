<?php

namespace Litepie\User;

/*
 * Part of the Litepie package.
 *
 *
 * @package    Litepie
 * @version    5.1
 */

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'User');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('user', function ($app) {
            return $app->make('Litepie\User\User');
        });

        $this->app->bind(
            \Litepie\Contracts\User\RoleRepository::class,
            \Litepie\User\Repositories\Eloquent\RoleRepository::class
        );

        $this->app->singleton('user.role', function ($app) {
            return $app->make(\Litepie\Contracts\User\RoleRepository::class);
        });

        $this->app->bind(
            \Litepie\Contracts\User\UserRepository::class,
            \Litepie\User\Repositories\Eloquent\UserRepository::class
        );

        $this->app->singleton('user.user', function ($app) {
            return $app->make(\Litepie\Contracts\User\UserRepository::class);
        });

        $this->app->bind(
            \Litepie\Contracts\User\PermissionRepository::class,
            \Litepie\User\Repositories\Eloquent\PermissionRepository::class
        );

        $this->app->singleton('user.permission', function ($app) {
            return $app->make(\Litepie\Contracts\User\PermissionRepository::class);
        });

        $this->app->register(\Laravel\Socialite\SocialiteServiceProvider::class);
        $this->app->register(\Litepie\User\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\User\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\User\Providers\RouteServiceProvider::class);
        $this->app->register(\Greggilbert\Recaptcha\RecaptchaServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['user', 'user.role', 'user.permission'];
    }
}
