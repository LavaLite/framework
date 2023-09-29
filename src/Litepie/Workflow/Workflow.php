<?php

namespace Litepie\Workflow;

use Symfony\Component\Workflow\Workflow as SymfonyWorkflow;
use Closure;

class Workflow extends SymfonyWorkflow
{

    public function transitions(object $subject, $workflow = null)
    {
        $transitions = $this->getEnabledTransitions($subject, $workflow);
        $ret = [];
        foreach ($transitions as $t) {
            $ret[$t->getName()] = $t;
        }
        return $ret;
    }

    public function transition($transition, $workflow = null)
    {
        $transitions = $this
            ->getDefinition()
            ->getTransitions($this);
        foreach ($transitions as $t) {
            if ($t->getName() == $transition) {
                return $t;
            }
        }
        return null;
    }

    public function form($transition)
    {
        $meta = $this->getMetadataStore()
            ->getTransitionMetadata($transition);

        if (!isset($meta['form']['fields'])) {
            return null;
        }

        $form = $meta['form']['fields'];
        $item = collect($form)->map(function ($val) {
            $val['label'] = trans($val['label']);
            $val['placeholder'] = trans($val['placeholder']);
            if (isset($val['options']) && is_callable($val['options']) && $val['options'] instanceof Closure) {
                $val['options'] = call_user_func($val['options']);
            }
            return $val;
        });
        return $item;
    }
    public function previous($transition, $workflow = null)
    {
        $previousTransitions = [];
        $froms = $transition->getFroms();
        $transitions = $this->getDefinition()->getTransitions();
        foreach ($transitions as $transition) {
            $tos = $transition->getTos();
            if (count(array_intersect($froms, $tos)) > 0) {
                $previousTransitions[] = $transition;
            }
        }
        return $previousTransitions;
    }
}
