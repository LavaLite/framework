<?php

namespace Litepie\User;

/*
 * Part of the Litepie package.
 *
 *
 * @package    Litepie
 * @version    5.1
 */

use Blade;
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'user');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'user');
        $this->registerBladeExtensions();
        $this->registerJwtExtensions();
        $this->publishResources();
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
        $this->app->register(\Tymon\JWTAuth\Providers\LaravelServiceProvider::class);
    }

    /**
     * Register new blade extensions.
     */
    protected function registerBladeExtensions()
    {

        if (false === $this->app['config']->get('user.template_helpers', true)) {
            return;
        }

        /*
         * add @shield and @endshield to blade compiler
         */
        Blade::directive('shield', function ($expression) {
            return "<?php if(app('user')->canDo{$expression}): ?>";
        });
        Blade::directive('endshield', function ($expression) {
            return '<?php endif; ?>';
        });

        /*
         * add @is and @endis to blade compiler
         */
        Blade::directive('is', function ($expression) {
            return "<?php if(app('user')->hasRoles{$expression}): ?>";
        });
        Blade::directive('endis', function ($expression) {
            return '<?php endif; ?>';
        });
    }

    /**
     * Implements jwt extension.
     */
    protected function registerJwtExtensions()
    {
        $this->app['auth']->extend('jwt-auth', function ($app, $name, array $config) {
            $guard = new Jwt\JwtAuthGuard(
                $app['tymon.jwt'],
                $app['auth']->createUserProvider($config['provider']),
                $app['request']
            );
            $app->refresh('request', $guard, 'setRequest');
            return $guard;
        });
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

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config.php' => config_path('user.php')], 'config');

        // Publish public view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/user')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/user')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/database/migrations' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/database/seeds' => base_path('database/seeds')], 'seeds');

        // Publish public folder
        $this->publishes([__DIR__ . '/public' => base_path('public')], 'public');

    }

}
