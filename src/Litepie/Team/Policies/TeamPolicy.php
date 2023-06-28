<?php

namespace Litepie\Team\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Team\Models\Team;

class TeamPolicy
{


    /**
     * Determine if the given user can view the team.
     *
     * @param UserPolicyInterface $authUser
     * @param Team $team
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Team $team)
    {
        if ($authUser->canDo('team.team.view') && $authUser->isAdmin()) {
            return true;
        }

        return $team->user_id == user_id() && $team->user_type == user_type();
    }

    /**
     * Determine if the given user can create a team.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('team.team.create');
    }

    /**
     * Determine if the given user can update the given team.
     *
     * @param UserPolicyInterface $authUser
     * @param Team $team
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Team $team)
    {
        if ($authUser->canDo('team.team.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $team->user_id == user_id() && $team->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given team.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Team $team)
    {
        return $team->user_id == user_id() && $team->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given team.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, Team $team)
    {
        if ($authUser->canDo('team.team.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given team.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, Team $team)
    {
        if ($authUser->canDo('team.team.approve')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $authUser    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before($authUser, $ability)
    {
        if ($authUser->isSuperuser()) {
            return true;
        }
    }
}
