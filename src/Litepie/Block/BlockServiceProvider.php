<?php

namespace Litepie\Block;

use Illuminate\Support\ServiceProvider;

class BlockServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'block');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'block');

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
        $this->app->bind('block', function ($app) {
            return $this->app->make('Litepie\Block\Block');
        });

        // Bind Category to repository
        $this->app->bind(
            \Litepie\Block\Interfaces\CategoryRepositoryInterface::class,
            \Litepie\Block\Repositories\Eloquent\CategoryRepository::class
        );

        // Bind Block to repository
        $this->app->bind(
            \Litepie\Block\Interfaces\BlockRepositoryInterface::class,
            \Litepie\Block\Repositories\Eloquent\BlockRepository::class
        );

        $this->app->register(\Litepie\Block\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Block\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Block\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['block'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/config.php' => config_path('litepie/block.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/block')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/block')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/database/seeds/' => base_path('database/seeds')], 'seeds');

        // Publish public
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'uploads');
    }
}
