<?php

namespace Litepie\Roles;

use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/config.php' => config_path('roles.php')
        ], 'config');

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'roles');

        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'roles');

        $this->registerBladeExtensions();

        $this->app->register(\Litepie\Roles\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Roles\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Roles\Providers\RouteServiceProvider::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind Roles to repository
        $this->app->bind(
            'Litepie\Roles\Interfaces\RoleRepositoryInterface',
            \Litepie\Roles\Repositories\Eloquent\RoleRepository::class
        );

        // Bind Permissions to repository
        $this->app->bind(
            'Litepie\Roles\Interfaces\PermissionRepositoryInterface',
            \Litepie\Roles\Repositories\Eloquent\PermissionRepository::class
        );
    }

    /**
     * Register Blade extensions.
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->directive('role', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->is{$expression}): ?>";
        });

        $blade->directive('endrole', function () {
            return "<?php endif; ?>";
        });

        $blade->directive('permission', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->can{$expression}): ?>";
        });

        $blade->directive('endpermission', function () {
            return "<?php endif; ?>";
        });

        $blade->directive('level', function ($expression) {
            $level = trim($expression, '()');

            return "<?php if (Auth::check() && Auth::user()->level() >= {$level}): ?>";
        });

        $blade->directive('endlevel', function () {
            return "<?php endif; ?>";
        });

        $blade->directive('allowed', function ($expression) {
            return "<?php if (Auth::check() && Auth::user()->allowed{$expression}): ?>";
        });

        $blade->directive('endallowed', function () {
            return "<?php endif; ?>";
        });
    }
}
