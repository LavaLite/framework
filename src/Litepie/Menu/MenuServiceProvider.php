<?php

namespace Litepie\Menu;

use Illuminate\Support\ServiceProvider;
use Litepie\Menu\Models\Menu;

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
        $this->loadViewsFrom(__DIR__.'/views', 'Menu');

        include __DIR__.'/Http/routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('menu', function ($app) {
            return $this->app->make('Litepie\Menu\Menu');
        });

        $this->app->bind('Litepie\\Contracts\\Menu\\MenuRepository',
            'Litepie\\Menu\\Repository\\MenuRepository');
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
}
