<?php

namespace Litepie\Form;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

/**
 * Register the Former package with the Laravel framework.
 */
class FormServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__.'/resources/views/', 'form');

        $this->publishResources();
    }

    /**
     * Register Former's package with Laravel.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config.php', 'form');

        $this->app = static::make($this->app);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['form'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__.'/config.php' => config_path('form.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__.'/resources/views' => base_path('resources/views/vendor/form')], 'view');
    }

    /**
     * Create a Former container.
     *
     * @param Container $app
     *
     * @return Container
     */
    public static function make($app = null)
    {
        $app->singleton('form.field', function ($app) {
            return new Fields($app);
        });

        $app->singleton('form.lists', function () {
            return new Lists();
        });

        $app->singleton('form', function ($app) {
            return new Form($app, $app->make('form.field'), $app->make('form.lists'));
        });

        return $app;
    }
}
