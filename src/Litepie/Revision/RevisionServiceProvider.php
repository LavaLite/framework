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
        $this->publishResources();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
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
        // Publish migrations
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')], 'migrations');
    }
}
