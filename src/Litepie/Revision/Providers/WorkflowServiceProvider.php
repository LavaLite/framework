<?php

namespace Litepie\Revision\Providers;

use Litepie\Contracts\Workflow\Workflow as WorkflowContract;
use Litepie\Foundation\Support\Providers\WorkflowServiceProvider as ServiceProvider;

class WorkflowServiceProvider extends ServiceProvider
{
    /**
     * The validator mappings for the package.
     *
     * @var array
     */
    protected $validators = [
        // Bind Revision validator
        \Litepie\Revision\Models\Revision::class => \Litepie\Revision\Workflow\RevisionValidator::class,
    ];

    /**
     * The validator mappings for the package.
     *
     * @var array
     */
    protected $actions = [
        // Bind Revision validator
        \Litepie\Revision\Models\Revision::class => \Litepie\Revision\Workflow\RevisionAction::class,
    ];

    /**
     * The validator mappings for the package.
     *
     * @var array
     */
    protected $notifiers = [
        // Bind Revision validator
        \Litepie\Revision\Models\Revision::class => \Litepie\Revision\Workflow\RevisionNotification::class,
    ];

    /**
     * Register any package workflow validation services.
     *
     * @param \Litepie\Contracts\Workflow\Workflow $workflow
     *
     * @return void
     */
    public function boot(WorkflowContract $workflow)
    {
        parent::registerValidators($workflow);
        parent::registerActions($workflow);
        parent::registerNotifiers($workflow);
    }
}
