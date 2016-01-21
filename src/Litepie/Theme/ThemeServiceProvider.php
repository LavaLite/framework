<?php

namespace Litepie\Theme;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
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
    }

    /**
     * Register service provider.
     *
     * @return void
     */
    public function register()
    {

        // Temp to use in closure.
        $app = $this->app;

        // Register providers.
        $this->registerAsset();
        $this->registerTheme();
    }

    /**
     * Register asset provider.
     *
     * @return void
     */
    public function registerAsset()
    {
        $this->app['asset'] = $this->app->share(function ($app) {
            return new Asset();
        });
    }

    /**
     * Register theme provider.
     *
     * @return void
     */
    public function registerTheme()
    {
        $this->app['theme'] = $this->app->share(function ($app) {
            return new Theme($app['config'], $app['events'], $app['view'], $app['asset'], $app['files']);
        });

        $this->app->alias('theme', 'Litepie\Theme\Contracts\Theme');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['asset', 'theme'];
    }
}
