<?php

namespace Litepie\Team\Policies;

use Litepie\User\Contracts\UserPolicy;
use Litepie\User\Models\Team;

class TeamPolicy
{
    /**
     * Determine if the given user can view the team.
     *
     * @param UserPolicy $user
     * @param Team       $team
     *
     * @return bool
     */
    public function view(UserPolicy $user, Team $team)
    {
        if ($user->canDo('teams.team.view') && $user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can create a team.
     *
     * @param UserPolicy $user
     * @param Team       $team
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return $user->canDo('teams.team.create');
    }

    /**
     * Determine if the given user can update the given team.
     *
     * @param UserPolicy $user
     * @param Team       $team
     *
     * @return bool
     */
    public function update(UserPolicy $user, Team $team)
    {
        if ($user->canDo('teams.team.edit') && $user->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can delete the given team.
     *
     * @param UserPolicy $user
     * @param Team       $team
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Team $team)
    {
        return false;
    }

    /**
     * Determine if the given user can verify the given team.
     *
     * @param UserPolicy $user
     * @param Team       $team
     *
     * @return bool
     */
    public function verify(UserPolicy $user, Team $team)
    {
        if ($user->canDo('teams.team.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given team.
     *
     * @param UserPolicy $user
     * @param Team       $team
     *
     * @return bool
     */
    public function approve(UserPolicy $user, Team $team)
    {
        if ($user->canDo('teams.team.approve')) {
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
