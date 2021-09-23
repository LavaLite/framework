<?php

namespace Litepie\Workflow\Traits;

/**
 * @author Boris Koumondji <brexis@yahoo.fr>
 */
trait WorkflowControllerTrait
{
    public function applyTransition($transition)
    {
        return app('workflow')->get($this, $workflowName);
    }

    public function getTransissions()
    {
        return $this->workflow($workflowName)->getEnabledTransitions($this);
    }
}
