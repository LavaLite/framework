<?php

namespace Litepie\Workflow\Policies;

use App\User;
use Litepie\Workflow\Models\Workflow;

class WorkflowPolicy
{

    /**
     * Determine if the given user can view the workflow.
     *
     * @param User $user
     * @param Workflow $workflow
     *
     * @return bool
     */
    public function view(User $user, Workflow $workflow)
    {
        if ($user->canDo('workflow.workflow.view') && $user->isAdmin()) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id == $workflow->user_id;
    }

    /**
     * Determine if the given user can create a workflow.
     *
     * @param User $user
     * @param Workflow $workflow
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('workflow.workflow.create');
    }

    /**
     * Determine if the given user can update the given workflow.
     *
     * @param User $user
     * @param Workflow $workflow
     *
     * @return bool
     */
    public function update(User $user, Workflow $workflow)
    {
        if ($user->canDo('workflow.workflow.update') && $user->isAdmin()) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id == $workflow->user_id;
    }

    /**
     * Determine if the given user can delete the given workflow.
     *
     * @param User $user
     * @param Workflow $workflow
     *
     * @return bool
     */
    public function destroy(User $user, Workflow $workflow)
    {
        if ($user->canDo('workflow.workflow.delete') && $user->isAdmin()) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id == $workflow->user_id;
    }

    /**
     * Determine if the given user can verify the given workflow.
     *
     * @param User $user
     * @param Workflow $workflow
     *
     * @return bool
     */
    public function verify(User $user, Workflow $workflow)
    {
        if ($user->canDo('workflow.workflow.verify') && $user->isAdmin()) {
            return true;
        }

        if ($user->canDo('workflow.workflow.verify') 
        && $user->is('manager')
        && $workflow->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given workflow.
     *
     * @param User $user
     * @param Workflow $workflow
     *
     * @return bool
     */
    public function approve(User $user, Workflow $workflow)
    {
        if ($user->canDo('workflow.workflow.approve') && $user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $user    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($user, $ability)
    {
        if ($user->isSuperuser()) {
            return true;
        }
    }
}
