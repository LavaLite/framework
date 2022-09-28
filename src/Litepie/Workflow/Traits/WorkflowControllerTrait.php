<?php

namespace Litepie\Workflow\Traits;


trait WorkflowControllerTrait
{

    public function apply($transission, $workflow = null, $context = [])
    {
        $this->model->workflow($workflow)->apply($transission, $context);
        $this->model->save();
        return $this->model;
    }

    public function get($workflow = null)
    {
        return $this->model->workflow($workflow)->get();
    }

    public function can($transitions, $workflow = null)
    {
        return $this->model->workflow($workflow)->can($transitions);
    }

    public function transitions($workflow = null)
    {
        return $this->model->workflow($workflow)->transitions();
    }
}
