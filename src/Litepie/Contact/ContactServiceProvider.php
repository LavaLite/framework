<?php

namespace Litepie\Contact;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'contact');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'contact');

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
        $this->app->bind('contact', function ($app) {
            return $this->app->make('Litepie\Contact\Contact');
        });

        // Bind Contact to repository
        $this->app->bind(
            \Litepie\Contact\Interfaces\ContactRepositoryInterface::class,
            \Litepie\Contact\Repositories\Eloquent\ContactRepository::class
        );

        $this->app->register(\Litepie\Contact\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Contact\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Contact\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['contact'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/config.php' => config_path('litepie/contact.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/contact')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/contact')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/database/seeds/' => base_path('database/seeds')], 'seeds');

        // Publish public
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'uploads');
    }
}
