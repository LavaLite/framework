<?php

namespace Litepie\Master;

use Illuminate\Support\ServiceProvider;
use Litepie\Master\Masters;

class MasterServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'master');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'master');

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

        $this->app->register(\Litepie\Master\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Master\Providers\RouteServiceProvider::class);
    }


    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade() {
        $this->app->bind('master', function($app)
        {
            return $this->app->make(Master::class);
        });
    }

    /**
     * Merges user's and master's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/master.php', 'master'
        );
        
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['master'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/' => config_path('/')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/master')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/master')], 'lang');

        // Publish public files and assets.
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'public');
    }
}
