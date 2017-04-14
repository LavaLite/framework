<?php

namespace Litepie\Revision;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider.
 */
class RevisionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * @return void
     */
    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'revision');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'revision');

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
        $this->app->bind('revision', function ($app) {
            return $this->app->make('Litepie\Revision\Revision');
        });

        // Bind Activity to repository
        $this->app->bind(
            'Litepie\Revision\Interfaces\ActivityRepositoryInterface',
            \Litepie\Revision\Repositories\Eloquent\ActivityRepository::class
        );

        // Bind Revision to repository
        $this->app->bind(
            'Litepie\Revision\Interfaces\RevisionRepositoryInterface',
            \Litepie\Revision\Repositories\Eloquent\RevisionRepository::class
        );

        $this->app->register(\Litepie\Revision\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Revision\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Revision\Providers\RouteServiceProvider::class);
        $this->app->register(\Litepie\Revision\Providers\WorkflowServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['revision'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__.'/config/config.php' => config_path('litepie/revision.php')], 'config');
    }
}
