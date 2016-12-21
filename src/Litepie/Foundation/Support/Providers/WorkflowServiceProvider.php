<?php

namespace Litepie\Foundation\Support\Providers;

use Illuminate\Support\ServiceProvider;
use Litepie\Contracts\Workflow\Workflow as WorkflowContract;

class WorkflowServiceProvider extends ServiceProvider
{
    /**
     * The Validator mapping for the model.
     *
     * @var array
     */
    protected $validators = [];

    /**
     * The Actions mapping for the model.
     *
     * @var array
     */
    protected $actions = [];

    /**
     * The notifyers mapping for the model.
     *
     * @var array
     */
    protected $notifiers = [];

    /**
     * Register the packages's workflow validators.
     *
     * @param  \Litepie\Contracts\Workflow\Workflow  $workflow
     * @return void
     */
    public function registerValidators(WorkflowContract $workflow)
    {

        foreach ($this->validators as $key => $value) {
            $workflow->validator($key, $value);
        }

    }

    /**
     * Register the packages's workflow actions.
     *
     * @param  \Litepie\Contracts\Workflow\Workflow  $workflow
     * @return void
     */
    public function registerActions(WorkflowContract $workflow)
    {

        foreach ($this->actions as $key => $value) {
            $workflow->actions($key, $value);
        }

    }

    /**
     * Register the packages's workflow notifications.
     *
     * @param  \Litepie\Contracts\Workflow\Workflow  $workflow
     * @return void
     */
    public function registerNotifiers(WorkflowContract $workflow)
    {

        foreach ($this->notifiers as $key => $value) {
            $workflow->notifier($key, $value);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
    }

}
