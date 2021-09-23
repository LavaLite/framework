<?php

namespace Litepie\Workflow;

use Illuminate\Support\ServiceProvider;

/**
 * @author Boris Koumondji <brexis@yahoo.fr>
 */
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
        $configPath = __DIR__.'/../config/config.php';

        $this->publishes([$configPath => config_path('workflow.php')], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);

        $this->app->singleton(
            'workflow',
            function ($app) {
                return new WorkflowRegistry();
            }
        );
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
