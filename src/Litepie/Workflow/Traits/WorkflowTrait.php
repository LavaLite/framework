<?php

namespace Litepie\Workflow\Traits;

use Workflow;


trait WorkflowTrait
{
    public function workflow_apply($transition, $workflow = null, array $context = [])
    {
        return Workflow::get($this, $workflow)->apply($this, $transition, $context);
    }

    public function workflow_can($transition, $workflow = null)
    {
        return Workflow::get($this, $workflow)->can($this, $transition);
    }

    public function workflow_transitions($workflow = null)
    {
        // dd(Workflow::get($this, $workflow));
        return Workflow::get($this, $workflow)->getEnabledTransitions($this);
    }

    public function workflow_get($workflow = null)
    {
        return Workflow::get($this, $workflow);
    }

    public function get_workflow_transition($transition, $workflow = null)
    {
        $transitions = Workflow::get($this, $workflow)
            ->getDefinition()
            ->getTransitions($this);
        foreach ($transitions as $t) {
            if ($t->getName() == $transition) return $t;
        }
        return null;
    }

    public function previous_workflow_transitions($transition, $workflow = null)
    {
        $previousTransitions = [];
        $workflow = Workflow::get($this, $workflow);
        $froms = $transition->getFroms();
        $transitions = $workflow->getDefinition()->getTransitions();
        foreach($transitions as $transition){
            $tos = $transition->getTos();
            if(count(array_intersect($froms, $tos)) > 0)
                $previousTransitions[] = $transition;
        }
        return $previousTransitions;
    }
}