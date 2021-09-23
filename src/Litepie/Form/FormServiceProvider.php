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
        $app->singleton('form.populator', function ($app) {
            return new Populator();
        });
        $app->singleton('form.field', function ($app) {
            return new Fields($app);
        });
        $app->singleton('form.form', function ($app) {
            return new Form($app, $app->make('form.populator'), $app->make('form.field'));
        });

        return $app;
    }
}
