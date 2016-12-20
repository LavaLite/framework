<?php

namespace Litepie\User\Providers;

use Litepie\Contracts\Workflow\Workflow as WorkflowContract;
use Litepie\Foundation\Support\Providers\WorkflowServiceProvider as ServiceProvider;

class WorkflowServiceProvider extends ServiceProvider
{
    /**
     * The validators mappings for the package.
     *
     * @var array
     */
    protected $validators = [
        // Bind User validator
        \Litepie\User\Models\User::class => \Litepie\User\Workflow\UserValidator::class,

        // Bind Team validator
        \Litepie\User\Models\Team::class => \Litepie\User\Workflow\TeamValidator::class,
    ];

    /**
     * The actions mappings for the package.
     *
     * @var array
     */
    protected $actions = [
        // Bind User actions
        \Litepie\User\Models\User::class => \Litepie\User\Workflow\UserAction::class,

        // Bind Team actions
        \Litepie\User\Models\Team::class => \Litepie\User\Workflow\TeamAction::class,
    ];

    /**
     * The notifiers mappings for the package.
     *
     * @var array
     */
    protected $notifiers = [
       // Bind User notifiers
        \Litepie\User\Models\User::class => \Litepie\User\Workflow\UserNotifier::class,

        // Bind Team notifiers
        \Litepie\User\Models\Team::class => \Litepie\User\Workflow\TeamNotifier::class,
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