<?php

namespace Litepie\Alert;

use Illuminate\Support\ServiceProvider;

class AlertServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'alert');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'alert');

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
        // Bind facade
        $this->app->bind('alert', function ($app) {
            return $this->app->make('Litepie\Alert\Alert');
        });

        // Bind Notification to repository
        $this->app->bind(
            'Litepie\Alert\Interfaces\NotificationRepositoryInterface',
            \Litepie\Alert\Repositories\Eloquent\NotificationRepository::class
        );

        $this->app->register(\Litepie\Alert\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Alert\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Alert\Providers\RouteServiceProvider::class);
        // $this->app->register(\Litepie\Alert\Providers\WorkflowServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['alert'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/config.php' => config_path('litepie/alert.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/alert')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/alert')], 'lang');

        // Publish public files and assets.
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'public');
    }
}
