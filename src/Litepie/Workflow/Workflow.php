<?php
namespace Litepie\Workflow;

use Symfony\Component\Workflow\Workflow as SymfonyWorkflow;

class Workflow  extends SymfonyWorkflow
{

    public function transitions(object $subject, $workflow = null){
        return $this->getEnabledTransitions($subject, $workflow);
    }

    public function transition($transition, $workflow = null){
        $transitions = $this
            ->getDefinition()
            ->getTransitions($this);
        foreach ($transitions as $t) {
            if ($t->getName() == $transition) return $t;
        }
        return null;
    }

    public function previous($transition, $workflow = null){
        $previousTransitions = [];
        $froms = $transition->getFroms();
        $transitions = $this->getDefinition()->getTransitions();
        foreach($transitions as $transition){
            $tos = $transition->getTos();
            if(count(array_intersect($froms, $tos)) > 0)
                $previousTransitions[] = $transition;
        }
        return $previousTransitions;
    }
}
