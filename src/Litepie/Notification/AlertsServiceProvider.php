<?php

namespace Litepie\Notification;

use Illuminate\Support\ServiceProvider;

class AlertsServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__.'/resources/views', 'alerts');

        // Load translation
        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'alerts');

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
        // Bind facade
        $this->app->bind('alerts', function ($app) {
            return $this->app->make('Litepie\Notification\Alerts');
        });

        // Bind Notification to repository
        $this->app->bind(
            'Litepie\Notification\Interfaces\NotificationRepositoryInterface',
            \Litepie\Notification\Repositories\Eloquent\NotificationRepository::class
        );

        $this->app->register(\Litepie\Notification\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Notification\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['alerts'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__.'/config/config.php' => config_path('litepie/alerts.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__.'/resources/views' => base_path('resources/views/vendor/alerts')], 'view');

        // Publish language files
        $this->publishes([__DIR__.'/resources/lang' => base_path('resources/lang/vendor/alerts')], 'lang');

        // Publish public files and assets.
        $this->publishes([__DIR__.'/public/' => public_path('/')], 'public');
    }
}
