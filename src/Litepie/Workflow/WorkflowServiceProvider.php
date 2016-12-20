<?php
namespace Litepie\Workflow;

use Illuminate\Support\ServiceProvider;
use Litepie\Workflow\Workflow;
use Litepie\Contracts\Workflow\Workflow as WorkflowContract;

class WorkflowServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind 'workflow' shared component to the IoC container
        $this->app->bind('workflow', function ($app) {
            return new Workflow($app);
        });

        $this->app->singleton(WorkflowContract::class, function ($app) {
            return new Workflow($app);
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [WorkflowContract::class];
    }

}
