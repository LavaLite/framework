<?php

namespace Litepie\Notification;

use Illuminate\Support\ServiceProvider;
use Litepie\Notification\Notifications;

class NotificationServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'notification');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'notification');

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
        $this->registerCommands();

        $this->app->register(\Litepie\Notification\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Notification\Providers\RouteServiceProvider::class);
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade() {
        $this->app->bind('notification', function($app)
        {
            return $this->app->make(Notifications::class);
        });
    }

    /**
     * Merges user's and notification's configs.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/notification.php', 'notification'
        );
    }

    /**
     * Register scaffolding command
     */
    protected function registerCommands()
    {
        // if ($this->app->runningInConsole()) {
        //     $this->commands([
        //         \Litepie\Notification\Commands\Notification::class,
        //     ]);
        // }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['notification'];
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
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/notification')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/notification')], 'lang');

        // Publish public files and assets.
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'public');
    }
}
