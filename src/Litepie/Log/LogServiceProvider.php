<?php

namespace Litepie\Log;

use Illuminate\Support\ServiceProvider;
use Litepie\Log\Logs;

class LogServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'log');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'log');

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

        $this->app->register(\Litepie\Log\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Log\Providers\RouteServiceProvider::class);
    }


    /**
     * Merges user's and log's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php', 'litepie.log'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . '/config/action.php', 'litepie.log.action'
        );
        $this->mergeConfigFrom(
            __DIR__ . '/config/activity.php', 'litepie.log.activity'
        );
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['litepie.log'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/' => config_path('litepie/log')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/log')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/log')], 'lang');

        // Publish public files and assets.
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'public');
    }
}
