<?php

namespace Litepie\Workflow\Traits;

trait Workflowable
{
    public function workflow($workflow = null)
    {
        return app('workflow')->get($this, $workflow);
    }

    public function transitions($workflow = null)
    {
        $workflow = $this->workflow($workflow);
        if(empty($workflow)) return [];
        $transitions =  $workflow?->transitions($this, $workflow);
        foreach ($transitions as $key => $transition) {
            $transitions[$key]->form = $workflow->form($transition);
        }
        return $transitions;
    }
}
