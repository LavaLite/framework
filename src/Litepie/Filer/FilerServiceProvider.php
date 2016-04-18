<?php

namespace Litepie\Filer;

use Illuminate\Support\ServiceProvider;

class FilerServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/views', 'filer');
        $this->app->register('\Intervention\Image\ImageServiceProvider');
        $this->publishResources();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('filer', function ($app) {
            return new \Litepie\Filer\Filer();
        });

        $this->app->register(\Litepie\Filer\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['filer'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/../../../../config/config.php' => config_path('package/package.php')], 'config');

        // Publish public view
        $this->publishes([__DIR__ . '/../../../../resources/views/public' => base_path('resources/views/vendor/package/public')], 'view-public');

        // Publish admin view
        $this->publishes([__DIR__ . '/../../../../resources/views/admin' => base_path('resources/views/vendor/package/admin')], 'view-admin');

        // Publish language files
        $this->publishes([__DIR__ . '/../../../../resources/lang' => base_path('resources/lang/vendor/package')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/../../../../database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/../../../../database/seeds/' => base_path('database/seeds')], 'seeds');
    }
}
