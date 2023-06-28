<?php

namespace Litepie\Role\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Role\Models\Role;

class RolePolicy
{


    /**
     * Determine if the given user can view the role.
     *
     * @param UserPolicyInterface $authUser
     * @param Role $role
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Role $role)
    {
        return false;
    }

    /**
     * Determine if the given user can create a role.
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
     * Determine if the given user can update the given role.
     *
     * @param UserPolicyInterface $authUser
     * @param Role $role
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Role $role)
    {
        return false;
    }

    /**
     * Determine if the given user can delete the given role.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Role $role)
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
