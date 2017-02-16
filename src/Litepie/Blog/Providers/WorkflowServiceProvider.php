<?php

namespace Litepie\Blog\Providers;

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
        // Bind Blog validator
        \Litepie\Blog\Models\Blog::class => \Litepie\Blog\Workflow\BlogValidator::class,

        // Bind BlogCategory validator
        \Litepie\Blog\Models\BlogCategory::class => \Litepie\Blog\Workflow\BlogCategoryValidator::class,
    ];

    /**
     * The actions mappings for the package.
     *
     * @var array
     */
    protected $actions = [
        // Bind Blog actions
        \Litepie\Blog\Models\Blog::class => \Litepie\Blog\Workflow\BlogAction::class,

        // Bind BlogCategory actions
        \Litepie\Blog\Models\BlogCategory::class => \Litepie\Blog\Workflow\BlogCategoryAction::class,
    ];

    /**
     * The notifiers mappings for the package.
     *
     * @var array
     */
    protected $notifiers = [
       // Bind Blog notifiers
        \Litepie\Blog\Models\Blog::class => \Litepie\Blog\Workflow\BlogNotifier::class,

        // Bind BlogCategory notifiers
        \Litepie\Blog\Models\BlogCategory::class => \Litepie\Blog\Workflow\BlogCategoryNotifier::class,
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
