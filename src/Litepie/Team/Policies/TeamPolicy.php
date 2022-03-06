<?php

namespace Litepie\Team\Policies;

use Litepie\Team\Interfaces\TeamRepositoryInterface;
use Litepie\User\Interfaces\UserPolicyInterface;

class TeamPolicy
{
    /**
     * Determine if the given user can view the team.
     *
     * @param UserPolicyInterface     $authUser
     * @param TeamRepositoryInterface $team
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, TeamRepositoryInterface $team)
    {
        return false;
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
        return false;
    }

    /**
     * Determine if the given user can update the given team.
     *
     * @param UserPolicyInterface     $authUser
     * @param TeamRepositoryInterface $team
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, TeamRepositoryInterface $team)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given team.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, TeamRepositoryInterface $team)
    {
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
