<?php

namespace Litepie\Task;

use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'task');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'task');

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
        $this->app->bind('task', function ($app) {
            return $this->app->make('Litepie\Task\Task');
        });

        // Bind Task to repository
        $this->app->bind(
            \Litepie\Task\Interfaces\TaskRepositoryInterface::class,
            \Litepie\Task\Repositories\Eloquent\TaskRepository::class
        );

        $this->app->register(\Litepie\Task\Providers\AuthServiceProvider::class);
        $this->app->register(\Litepie\Task\Providers\EventServiceProvider::class);
        $this->app->register(\Litepie\Task\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['task'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/config/config.php' => config_path('litepie/task.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/resources/views' => base_path('resources/views/vendor/task')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/resources/lang' => base_path('resources/lang/vendor/task')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/database/seeds/' => base_path('database/seeds')], 'seeds');

        // Publish public
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'uploads');
    }
}
