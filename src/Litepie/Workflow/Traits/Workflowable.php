<?php

namespace Litepie\Workflow\Traits;

trait Workflowable
{
    public function workflow($workflow = null)
    {
        return app('workflow')->get($this, $workflow);
    }
}
