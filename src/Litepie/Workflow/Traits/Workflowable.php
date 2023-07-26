<?php

namespace Litepie\Workflow\Traits;

trait Workflowable
{
    /**
     * Get the workflow instance for the model.
     *
     * @param  string|null  $workflow
     * @return \Litepie\Workflow\Workflow
     */
    public function workflow($workflow = null)
    {
        return app('workflow')->get($this, $workflow);
    }

    /**
     * Get the available transitions for the model.
     *
     * @param  string|null  $workflow
     * @return array
     */
    public function transitions($workflow = null)
    {
        $workflow = $this->workflow($workflow);
        if (empty($workflow)) {
            return [];
        }

        $transitions = $workflow->transitions($this, $workflow);
        foreach ($transitions as $key => $transition) {
            $transitions[$key]->form = $workflow->form($transition);
        }
        return $transitions;
    }

    /**
     * Check if the model can perform the given actions.
     *
     * @param  array  $roles
     * @return bool
     */
    public function canDoActions($roles)
    {
        if ($this->team && $this->team->hasTeamRole($roles['team'] ?? null, true)) {
            return true;
        }
        if (user()->hasRole($roles['user'] ?? null)) {
            return true;
        }

        if ($roles['model'] ?? null) {
            foreach ($roles['model'] as $model) {
                if ($this->$model) {
                    return true;
                }
            }
        }

        return false;
    }
}
