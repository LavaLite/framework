<?php

namespace Litepie\User\Policies;

use App\User;
use Litepie\User\Models\Team;

class TeamPolicy
{
    /**
     * Determine if the given user can view the team.
     *
     * @param User $user
     * @param Team $team
     *
     * @return bool
     */
    public function view(User $user, Team $team)
    {
        if ($user->canDo('user.team.view') && $user->isAdmin()) {
            return true;
        }

        if ($user->canDo('blocks.block.view')
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id == $team->user_id;
    }

    /**
     * Determine if the given user can create a team.
     *
     * @param User $user
     * @param Team $team
     *
     * @return bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine if the given user can update the given team.
     *
     * @param User $user
     * @param Team $team
     *
     * @return bool
     */
    public function update(User $user, Team $team)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given team.
     *
     * @param User $user
     * @param Team $team
     *
     * @return bool
     */
    public function destroy(User $user, Team $team)
    {
        return false;
    }

    /**
     * Determine if the given user can verify the given team.
     *
     * @param User $user
     * @param Team $team
     *
     * @return bool
     */
    public function verify(User $user, Team $team)
    {
        return false;
    }

    /**
     * Determine if the given user can approve the given team.
     *
     * @param User $user
     * @param Team $team
     *
     * @return bool
     */
    public function approve(User $user, Team $team)
    {
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
