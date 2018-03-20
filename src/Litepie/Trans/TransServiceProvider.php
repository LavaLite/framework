<?php

namespace Litepie\Trans;

use Illuminate\Support\ServiceProvider;

class TransServiceProvider extends ServiceProvider
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
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['trans'];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config.php', 'trans');

        $this->app->bind('trans', function ($app) {
            return $this->app->make('\Litepie\Trans\Trans');
        });
    }
}
