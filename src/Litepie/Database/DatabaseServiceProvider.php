<?php

namespace Litepie\Database;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider.
 */
class DatabaseServiceProvider extends ServiceProvider
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
        $this->publishResources();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('Litepie\Database\Providers\EventServiceProvider');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Merge configuration file
        $this->mergeConfigFrom([__DIR__ . '/config.php', 'database');
    }
}
