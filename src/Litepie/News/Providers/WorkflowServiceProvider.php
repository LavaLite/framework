<?php

namespace Litepie\News\Providers;

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
        // Bind News validator
        \Litepie\News\Models\News::class => \Litepie\News\Workflow\NewsValidator::class,
    ];

    /**
     * The validator mappings for the package.
     *
     * @var array
     */
    protected $actions = [
        // Bind News validator
        \Litepie\News\Models\News::class => \Litepie\News\Workflow\NewsAction::class,
    ];

    /**
     * The validator mappings for the package.
     *
     * @var array
     */
    protected $notifiers = [
        // Bind News validator
        \Litepie\News\Models\News::class => \Litepie\News\Workflow\NewsNotification::class,
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
