<?php

namespace Litepie\Form;

use Former\FormerServiceProvider;

/**
 * Register the Former package with the Laravel framework.
 */
class FormServiceProvider extends FormerServiceProvider
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
        // Call pblish redources function
        $this->publishResources();
    }

    /**
     * Register Former's package with Laravel.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config.php', 'former');

        $this->app = static::make($this->app);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['form', 'former', 'Former\Former'];
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
}
