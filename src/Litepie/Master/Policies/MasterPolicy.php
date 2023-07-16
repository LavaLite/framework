<?php

namespace Litepie\Master\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\Master\Models\Master;

class MasterPolicy
{


    /**
     * Determine if the given user can view the master.
     *
     * @param Authenticatable $user
     * @param Master $master
     *
     * @return bool
     */
    public function view(Authenticatable $user, Master $master)
    {
        if ($user->canDo('master.master.view') && $user->isAdmin()) {
            return true;
        }

        return $master->user_id == user_id() && $master->user_type == user_type();
    }

    /**
     * Determine if the given user can create a master.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function create(Authenticatable $user)
    {
        return  $user->canDo('master.master.create');
    }

    /**
     * Determine if the given user can update the given master.
     *
     * @param Authenticatable $user
     * @param Master $master
     *
     * @return bool
     */
    public function update(Authenticatable $user, Master $master)
    {
        if ($user->canDo('master.master.edit') && $user->isAdmin()) {
            return true;
        }

        return $master->user_id == user_id() && $master->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given master.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, Master $master)
    {
        return $master->user_id == user_id() && $master->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given master.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function verify(Authenticatable $user, Master $master)
    {
        if ($user->canDo('master.master.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given master.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function approve(Authenticatable $user, Master $master)
    {
        if ($user->canDo('master.master.approve')) {
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
