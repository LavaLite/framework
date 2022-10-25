<?php

namespace Litepie\Workflow;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;

class WorkflowServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Litepie\Workflow\Commands\WorkflowDumpCommand',
    ];

    /**
     * Bootstrap the application services...
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . "/config/config.php" => config_path('workflow.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/config.php',
            'workflow'
        );

        $this->commands($this->commands);

        $this->app->singleton('workflow', function ($app) {
            $registryConfig = $app->make('config')->get('workflow');
            return new WorkflowRegistry($registryConfig, $app->make(Dispatcher::class));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['workflow'];
    }
}
