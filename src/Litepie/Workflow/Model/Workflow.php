<?php

namespace Litepie\Workflow\Model;

use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Ramsey\Uuid\Uuid;
use Litepie\Database\Model;
use Litepie\Workflow\Exceptions\WorkflowStepNotfoundException;
use Litepie\Workflow\Models\Workflow as WorkflowModel;
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
    public function applyWorkflow($step, $attributes = '')
    {
        $instance = WorkflowFacade::validate($step, $this);
        if ($instance instanceof Validator && $instance->fails()) {
            throw new ValidationException($instance);
        }

        try {
            $this->workflowAction($step);
            $workflows = $this->workflowModify($step, $attributes);
            $this->workflowNotify($workflows, $step);

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
     * Return next status based on current status.
     *
     * @return mixed
     */
    public function canDo($step)
    {
        if ($step == 'complete' && ($this->user->id == user_id())) {
            return true;
        }

        $workflow = $this->workflowHistory()
                        ->where('action', $step)
                        ->first();

        if (isset($workflow) && ($workflow->performable->id == user_id())) {
            return true;
        }

        return false;
    }

    /**
     * Return next status based on current status.
     *
     * @return mixed
     */
    public function addInfo($step)
    {
        if (isset($this->workflow['steps'][$step]['addlinfo'])) {
            return true;
        }
            
        return false;
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
    public function workflowNotify($workflows, $step)
    {

        if (isset($this->workflow['steps'][$step])) {
            $notify = array_get($this->workflow, "steps.{$step}.notify");

            return WorkflowFacade::notify($notify, $this, $workflows);
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

        return $this->workflow['points']['end'];

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


    /**
     * modify workflow.
     *
     * @return mixed
     */
    public function workflowModify($step, $attributes)
    {

        if (isset($this->workflow['steps'][$step])) {
            $update = $this->workflowUpdate($this->workflow['steps'][$step], $attributes);
            $create = $this->workflowCreate($this->workflow['steps'][$step]);

            return $create;
        }

        throw new WorkflowStepNotfoundException();
    }

    /**
     * create workflow.
     *
     * @return mixed
     */
    public function workflowCreate($step)
    {
        $result = [];
        $reporting_to = $this->reporting_to;
        foreach ($step['next'] as $key => $value) {
            if($step['action'] == 'cancel'){
                $workflow = WorkflowModel::where('action',$value)
                                ->whereWorkflowableType(get_class($this))
                                ->whereWorkflowableId($this->id)
                                ->whereStatus('completed')
                                ->first();
                $reporting_to = $workflow->performable_id;
            }
            $data = [
                'id'                => Uuid::uuid4()->toString(),
                'workflowable_id'   => $this->id,
                'workflowable_type' => get_class($this),
                'action'            => $value,
                'status'            => 'pending',
                'guard'             => getenv('guard'),
                'performable_id'    => $reporting_to,
                'performable_type'  => getenv('auth.model'),
            ];
            
            $workflow = WorkflowModel::create($data);
            $result[$key] = $workflow;
        }
        
        return $result;
    }

    /**
     * update workflow.
     *
     * @return mixed
     */
    public function workflowUpdate($step, $attributes)
    {   
            $data['status'] = 'completed';  
            if ($this->addInfo($step['action'])) {
                $data['data']    = json_encode($attributes);
            }
            $workflow = WorkflowModel::where('action',$step['action'])
                            ->where('workflowable_type', get_class($this))
                            ->where('workflowable_id', $this->id)
                            ->update($data);

            $row = WorkflowModel::where('status', 'pending')->delete();

            return $workflow;

        throw new WorkflowStepNotfoundException();
    }

}
