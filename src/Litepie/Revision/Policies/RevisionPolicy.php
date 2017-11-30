<?php

namespace Litepie\Revision\Policies;

use Litepie\Revision\Models\Revision;
use Litepie\User\Contracts\UserPolicy;

class RevisionPolicy
{

    /**
     * Determine if the given user can view the revision.
     *
     * @param User $user
     * @param Revision $revision
     *
     * @return bool
     */
    public function view(UserPolicy $user, Revision $revision)
    {
        if ($user->canDo('revision.revision.view') && $user->hasRole('admin')) {
            return true;
        }

        return $user->id == $revision->user_id && get_class($user) == $revision->user_type;
    }

    /**
     * Determine if the given user can create a revision.
     *
     * @param User $user
     * @param Revision $revision
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  $user->canDo('revision.revision.create');
    }

    /**
     * Determine if the given user can update the given revision.
     *
     * @param User $user
     * @param Revision $revision
     *
     * @return bool
     */
    public function update(UserPolicy $user, Revision $revision)
    {
        if ($user->canDo('revision.revision.update') && $user->hasRole('admin')) {
            return true;
        }


        return $user->id == $revision->user_id && get_class($user) == $revision->user_type;
    }

    /**
     * Determine if the given user can delete the given revision.
     *
     * @param User $user
     * @param Revision $revision
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Revision $revision)
    {
        if ($user->canDo('revision.revision.delete') && $user->hasRole('admin')) {
            return true;
        }

        return $user->id == $revision->user_id && get_class($user) == $revision->user_type;
    }

    /**
     * Determine if the user can perform a given action ve.
     *
     * @param [type] $user    [description]
     * @param [type] $ability [description]
     *
     * @return [type] [description]
     */
    public function before(UserPolicy $user, $ability)
    {
        if ($user->hasRole('superuser')) {
            return true;
        }
    }
}
