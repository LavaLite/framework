<?php

namespace Litepie\Workflow\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class WorkflowServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $workflow = [];

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function registerWorkflows()
    {
        foreach ($this->workflows() as $name => $value) {
            $this->app['workflow']->addFromArray($name, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        //
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function workflows()
    {
        return $this->workflow;
    }
}
