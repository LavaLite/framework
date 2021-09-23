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
        // Load translation
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'menu');

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
        $this->app->bind('litepie.menu', function ($app) {
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

        // Publish language files
        $this->publishes([__DIR__.'/resources/lang' => base_path('resources/lang/vendor/menu')], 'lang');
    }
}
