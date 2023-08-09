<?php

namespace Litepie\Workflow\Traits;

use Symfony\Component\Workflow\Transition;

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
     * Get a specific transition for the model.
     *
     * @param  string  $transition
     * @param  string|null  $workflow
     * @return bool
     */
    public function transition($transition, $workflow = null): Transition | null 
    {
        return $this->workflow($workflow)->transition($transition);
    }

    /**
     * Get the metadata for a specific transition.
     *
     * @param  string  $transition
     * @param  string|null  $workflow
     * @return array
     */
    public function getTransitionMetadata($transition, $workflow = null)
    {
        $transition = $this->transition($transition);
        if (empty($transition)) {
            return [];
        }
        return $this->workflow($workflow)
            ->getMetadataStore()
            ->getTransitionMetadata($transition);
    }

    /**
     * Check if the model can perform a specific transition.
     *
     * @param  array  $roles
     * @return bool
     */
    public function canDoTransition($roles)
    {
        if (empty($roles) && !user()->isSuperUser()) {
            return false;
        }

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
