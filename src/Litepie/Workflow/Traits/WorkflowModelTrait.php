<?php

namespace Litepie\Workflow\Traits;

use Symfony\Component\Workflow\Exception\LogicException;

/**
 * @author Boris Koumondji <brexis@yahoo.fr>
 */
trait WorkflowModelTrait
{
    public function workflow($workflowName = null)
    {
        return app('workflow')->get($this, $workflowName);
    }

    public function workflowApply($transition, $workflowName = null)
    {
        try {
            $this->workflow($workflowName)->apply($this, $transition);
            $this->save();

            return [$transition, 'Success'];
        } catch (LogicException $e) {
            return $e->getMessage();
        }
    }

    public function workflowAll()
    {
        return app('workflow')->all($this);
    }

    public function workflowCan($transition, $workflowName = null)
    {
        return $this->workflow($workflowName)->can($this, $transition);
    }

    public function workflowTransitions($workflowName = null)
    {
        return $this->workflow($workflowName)->getEnabledTransitions($this);
    }
}
