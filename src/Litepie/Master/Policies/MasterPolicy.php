<?php

namespace Litepie\Master\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Master\Models\Master;

class MasterPolicy
{


    /**
     * Determine if the given user can view the master.
     *
     * @param UserPolicyInterface $authUser
     * @param Master $master
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Master $master)
    {
        if ($authUser->canDo('master.master.view') && $authUser->isAdmin()) {
            return true;
        }

        return $master->user_id == user_id() && $master->user_type == user_type();
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
        return  $authUser->canDo('master.master.create');
    }

    /**
     * Determine if the given user can update the given master.
     *
     * @param UserPolicyInterface $authUser
     * @param Master $master
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Master $master)
    {
        if ($authUser->canDo('master.master.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $master->user_id == user_id() && $master->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given master.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Master $master)
    {
        return $master->user_id == user_id() && $master->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given master.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, Master $master)
    {
        if ($authUser->canDo('master.master.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given master.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, Master $master)
    {
        if ($authUser->canDo('master.master.approve')) {
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
