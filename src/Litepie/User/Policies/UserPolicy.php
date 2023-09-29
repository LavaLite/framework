<?php

namespace Litepie\User\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\User\Models\User;

class UserPolicy
{

    /**
     * Determine if the given user can view the user.
     *
     * @param Authenticatable $authUser
     * @param User $authUser
     *
     * @return bool
     */
    public function view(Authenticatable $authUser, User $user)
    {
        if ($authUser->canDo('user.user.view')) {
            return true;
        }

        return $user->owner();
    }

    /**
     * Determine if the given user can create a user.
     *
     * @param Authenticatable $authUser
     *
     * @return bool
     */
    public function create(Authenticatable $authUser)
    {
        return $authUser->canDo('user.user.create');
    }

    /**
     * Determine if the given user can update the given user.
     *
     * @param Authenticatable $authUser
     * @param User $authUser
     *
     * @return bool
     */
    public function update(Authenticatable $authUser, User $user)
    {
        if ($authUser->canDo('user.user.edit')) {
            return true;
        }

        return $user->owner();
    }

    /**
     * Determine if the given user can delete the given user.
     *
     * @param Authenticatable $authUser
     *
     * @return bool
     */
    public function destroy(Authenticatable $authUser, User $user)
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
