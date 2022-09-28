<?php

namespace Litepie\Foundation\Support\Providers;
use Illuminate\Support\ServiceProvider;

abstract class WorkflowServiceProvider extends ServiceProvider
{

    /**
     * The workflow mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $workflows = [];

    /**
     * Register the application's workflows.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->workflows() as $model => $workflow) {
            app('workflow')->addFromArray($model, $workflow);
        }
    }

    /**
     * Get the workflows defined on the provider.
     *
     * @return array<class-string, class-string>
     */
     public abstract function workflows();
}
