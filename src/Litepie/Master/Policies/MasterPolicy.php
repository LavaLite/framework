<?php

namespace Litepie\Master\Policies;

use Litepie\Master\Repositories\Eloquent\MasterRepository;
use Litepie\User\Interfaces\UserPolicyInterface;

class MasterPolicy
{
    /**
     * Determine if the given user can view the master.
     *
     * @param UserPolicyInterface $authUser
     * @param MasterRepository    $master
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, MasterRepository $master)
    {
        return false;
    }

    /**
     * Determine if the given user can create a master.
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
     * Determine if the given user can update the given master.
     *
     * @param UserPolicyInterface $authUser
     * @param MasterRepository    $master
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, MasterRepository $master)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given master.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, MasterRepository $master)
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
