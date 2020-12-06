<?php

namespace Litepie\Install;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Litepie\Install\Middleware\canInstall;
use Litepie\Install\Middleware\CanUpdate;

class InstallServiceProvider extends ServiceProvider
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
    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'install');
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'install');
        $router->middlewareGroup('install', [CanInstall::class]);
        $router->middlewareGroup('update', [CanUpdate::class]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            \Litepie\Install\InstallCommand::class,
        ]);

        $this->mergeConfigFrom(__DIR__.'/config/installer.php', 'installer');

        $this->app->register(\Litepie\Install\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['install'];
    }
}
