<?php

namespace Litepie\Menu;

use Illuminate\Support\ServiceProvider;

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
        // Load view
        $this->loadViewsFrom(__DIR__.'/resources/views', 'menu');

        // Load translation
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'menu');

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
        $this->mergeConfigFrom(__DIR__.'/config/menu.php', 'menu');

        // Bind facade
        $this->app->bind('menu', function ($app) {
            return $this->app->make('Litepie\Menu\Menu');
        });

        // Bind Menu to repository
        $this->app->bind(
            'Litepie\Menu\Interfaces\MenuRepositoryInterface',
            \Litepie\Menu\Repositories\Eloquent\MenuRepository::class
        );

        $this->app->register(\Litepie\Menu\Providers\AuthServiceProvider::class);
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
        $this->publishes([__DIR__.'/config/menu.php' => config_path('menu.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__.'/resources/views' => base_path('resources/views/vendor/menu')], 'view');

        // Publish language files
        $this->publishes([__DIR__.'/resources/lang' => base_path('resources/lang/vendor/menu')], 'lang');

        // Publish public files and assets.
        $this->publishes([__DIR__.'/public/' => public_path('/')], 'public');
    }
}
