<?php

namespace Litepie\Calendar;

use Illuminate\Support\ServiceProvider;

class CalendarServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'calendar');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'calendar');

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
        $this->app->bind('calendar', function ($app) {
            return $this->app->make('Litepie\Calendar\Calendar');
        });

        // Bind Calendar to repository
        $this->app->bind(
            \Litepie\Calendar\Interfaces\CalendarRepositoryInterface::class,
            \Litepie\Calendar\Repositories\Eloquent\CalendarRepository::class
        );

        $this->app->register(\Litepie\Calendar\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Calendar\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Calendar\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['calendar'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/config.php' => config_path('litepie/calendar.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/calendar')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/calendar')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/database/seeds/' => base_path('database/seeds')], 'seeds');

        // Publish public
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'uploads');
    }
}
