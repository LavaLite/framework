<?php

namespace Litepie\User\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\User\Models\User;

class UserPolicy
{


    /**
     * Determine if the given user can view the user.
     *
     * @param Authenticatable $user
     * @param User $user
     *
     * @return bool
     */
    public function view(Authenticatable $user, User $user)
    {
        if ($user->canDo('user.user.view') && $user->isAdmin()) {
            return true;
        }

        return $user->user_id == user_id() && $user->user_type == user_type();
    }

    /**
     * Determine if the given user can create a user.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function create(Authenticatable $user)
    {
        return  $user->canDo('user.user.create');
    }

    /**
     * Determine if the given user can update the given user.
     *
     * @param Authenticatable $user
     * @param User $user
     *
     * @return bool
     */
    public function update(Authenticatable $user, User $user)
    {
        if ($user->canDo('user.user.edit') && $user->isAdmin()) {
            return true;
        }

        return $user->user_id == user_id() && $user->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given user.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, User $user)
    {
        return $user->user_id == user_id() && $user->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given user.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function verify(Authenticatable $user, User $user)
    {
        if ($user->canDo('user.user.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given user.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function approve(Authenticatable $user, User $user)
    {
        if ($user->canDo('user.user.approve')) {
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
