<?php

namespace Litepie\User\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Litepie\Package\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can view the user.
     *
     * @param User $user
     * @param User $user
     *
     * @return bool
     */
    public function view(User $user, User $user)
    {
        if ($user->canDo('package.user.view')) {
            return true;
        }

        return $user->id === $user->user_id;
    }

    /**
     * Determine if the given user can create a user.
     *
     * @param User $user
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('package.user.create');
    }

    /**
     * Determine if the given user can update the given user.
     *
     * @param User $user
     * @param User $user
     *
     * @return bool
     */
    public function update(User $user, User $user)
    {
        if ($user->canDo('package.user.update')) {
            return true;
        }

        return $user->id === $user->user_id;
    }

    /**
     * Determine if the given user can delete the given user.
     *
     * @param User $user
     * @param User $user
     *
     * @return bool
     */
    public function destroy(User $user, User $user)
    {
        if ($user->canDo('package.user.delete')) {
            return true;
        }

        return $user->id === $user->user_id;
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
        if ($user->isSuperUser()) {
            return true;
        }
    }
}