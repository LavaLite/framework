<?php

namespace Litepie\Menu;

use Illuminate\Support\ServiceProvider;
use Litepie\Menu\Models\Menu;

class MenuServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'menu');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'menu');

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
        $this->app->bind('menu', function ($app) {
            return $this->app->make('Litepie\Menu\Menu');
        });

        $this->app->bind('Litepie\\Contracts\\Menu\\MenuRepository',
            'Litepie\\Menu\\Repository\\MenuRepository');

        $this->app->register(\Litepie\Menu\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Menu\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Menu\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['menu'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/config.php' => config_path('menu.php')], 'config');

        // Publish public view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/menu')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/menu')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/database/seeds/' => base_path('database/seeds')], 'seeds');
    }
}
