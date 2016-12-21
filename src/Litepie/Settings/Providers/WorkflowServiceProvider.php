<?php

namespace Litepie\Settings\Providers;

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
        
        // Bind Setting validator
        \Litepie\Settings\Models\Setting::class => \Litepie\Settings\Workflow\SettingValidator::class,
    ];

    /**
     * The actions mappings for the package.
     *
     * @var array
     */
    protected $actions = [
        
        // Bind Setting actions
        \Litepie\Settings\Models\Setting::class => \Litepie\Settings\Workflow\SettingAction::class,
    ];

    /**
     * The notifiers mappings for the package.
     *
     * @var array
     */
    protected $notifiers = [
       
        // Bind Setting notifiers
        \Litepie\Settings\Models\Setting::class => \Litepie\Settings\Workflow\SettingNotifier::class,
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
