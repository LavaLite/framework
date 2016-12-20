<?php

namespace Litepie\Workflow\Model;

use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Litepie\Database\Model;
use Litepie\Workflow\Exceptions\WorkflowStepNotfoundException;
use Workflow as WorkflowFacade;

trait Workflow
{

    /**
     * @var string The database table used by the model.
     */
    public $workflow = null;

    /**
     * Update workflow according to action given in the workflow configuration.
     *
     * @return mixed
     */
    public function applyWorkflow($step)
    {
        $instance = WorkflowFacade::validate($step, $this);

        if ($instance instanceof Validator && $instance->fails()) {
            throw new ValidationException($instance);
        }
        try {
            $this->workflowAction($step);

            $this->workflowNotify($step);

        }catch (Exception $e){
            throw $e;
            
        }

    }

    /*
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        dd('dddd');
    }

    /**
     * Returnw next status based on current status.
     *
     * @return mixed
     */
    public function getNextStep()
    {

        if (isset($this->workflow['steps'][$this->status]['next'])) {
            return $this->workflow['steps'][$this->status]['next'];
        }

        return [$this->workflow['points']['start']];

    }

    /**
     * Return next status based on current status.
     *
     * @return mixed
     */
    public function hasStep($step)
    {
        $steps = $this->getNextStep();
        return in_array($step, $steps);

    }

    /**
     * Returnw next status based on current status.
     *
     * @return mixed
     */
    public function workflowAction($step)
    {
        if (isset($this->workflow['steps'][$step])) {
            $action = array_get($this->workflow, "steps.{$step}.action");
            return WorkflowFacade::action($action, $this);
        }

        throw new WorkflowStepNotfoundException();
    }

    /**
     * Returnw next status based on current status.
     *
     * @return mixed
     */
    public function workflowNotify($step)
    {

        if (isset($this->workflow['steps'][$step])) {
            $notify = array_get($this->workflow, "steps.{$step}.notify");
            return WorkflowFacade::notify($notify, $this);
        }

        throw new WorkflowStepNotfoundException();
    }

    /**
     * Returnw next status based on current status.
     *
     * @return mixed
     */
    public function getLastStep()
    {

        return $this->workflow['points']['start'];

    }

    /**
     * Returnw next status based on current status.
     *
     * @return mixed
     */
    public function isFirstStep($step)
    {

        return $this->workflow['points']['start'] == $step;

    }

    /**
     * Returnw next status based on current status.
     *
     * @return mixed
     */
    public function isLastStep($step)
    {

        return in_array($step, $this->workflow['points']['end']);

    }

}
