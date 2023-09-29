<?php

namespace Litepie\Team\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\Team\Models\Team;

class TeamPolicy
{


    /**
     * Determine if the given user can view the team.
     *
     * @param Authenticatable $user
     * @param Team $team
     *
     * @return bool
     */
    public function view(Authenticatable $user, Team $team)
    {
        if ($user->canDo('team.team.view') && $user->isAdmin()) {
            return true;
        }

        return $team->user_id == user_id() && $team->user_type == user_type();
    }

    /**
     * Determine if the given user can create a team.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function create(Authenticatable $user)
    {
        return  $user->canDo('team.team.create');
    }

    /**
     * Determine if the given user can update the given team.
     *
     * @param Authenticatable $user
     * @param Team $team
     *
     * @return bool
     */
    public function update(Authenticatable $user, Team $team)
    {
        if ($user->canDo('team.team.edit') && $user->isAdmin()) {
            return true;
        }

        return $team->user_id == user_id() && $team->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given team.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, Team $team)
    {
        return $team->user_id == user_id() && $team->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given team.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function verify(Authenticatable $user, Team $team)
    {
        if ($user->canDo('team.team.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given team.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function approve(Authenticatable $user, Team $team)
    {
        if ($user->canDo('team.team.approve')) {
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
