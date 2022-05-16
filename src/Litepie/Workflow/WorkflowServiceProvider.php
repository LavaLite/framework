<?php

namespace Litepie\Workflow;

use Illuminate\Support\ServiceProvider;
use Litepie\Workflow\WorkflowRegistry;

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
        $configPath = $this->configPath();

        $this->publishes([
            "${configPath}/workflow.php" => config_path('workflow.php'),
            "${configPath}/workflow_registry.php" => config_path('workflow_registry.php')
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
            $this->configPath() . '/workflow_registry.php',
            'workflow_registry'
        );
        $this->mergeConfigFrom(
            $this->configPath() . '/workflow.php',
            'workflow'
        );

        $this->commands($this->commands);

        $this->app->singleton('workflow', function ($app) {
            $workflowConfigs = [];
            $registryConfig = $app->make('config')->get('workflow_registry');
            return new WorkflowRegistry($workflowConfigs, $registryConfig);
        });
    }

    protected function configPath()
    {
        return __DIR__ . '/config';
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

    /**
     * Register the application bindings.
     *
     * @return void
     */
    protected function registerWorkflows()
    {
        $this->app->bind('workflows', function($app) {
            return new Workflows($app);
        });
    }
}
