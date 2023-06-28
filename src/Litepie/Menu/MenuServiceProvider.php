<?php

namespace Litepie\Menu;

use Illuminate\Support\ServiceProvider;
use Litepie\Menu\Menus;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'menu');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'menu');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

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
        $this->mergeConfig();
        $this->registerFacade();

        $this->app->register(\Litepie\Menu\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Menu\Providers\RouteServiceProvider::class);
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade() {
        $this->app->bind('litepie.menu', function($app)
        {
            return $this->app->make(Menu::class);
        });
    }

    /**
     * Merges user's and menu's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/menu.php', 'menu'
        );
        
        
        $this->mergeConfigFrom(
            __DIR__ . '/config/menu.php', 'litepie.menu.menu'
        );
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['litepie.menu'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/' => config_path('litepie/menu')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/menu')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/menu')], 'lang');

        // Publish public files and assets.
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'public');
    }
}