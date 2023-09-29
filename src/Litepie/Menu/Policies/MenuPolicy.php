<?php

namespace Litepie\Menu\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\Menu\Models\Menu;

class MenuPolicy
{


    /**
     * Determine if the given user can view the menu.
     *
     * @param Authenticatable $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function view(Authenticatable $user, Menu $menu)
    {
        if ($user->canDo('menu.menu.view') && $user->isAdmin()) {
            return true;
        }

        return $menu->user_id == user_id() && $menu->user_type == user_type();
    }

    /**
     * Determine if the given user can create a menu.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function create(Authenticatable $user)
    {
        return  $user->canDo('menu.menu.create');
    }

    /**
     * Determine if the given user can update the given menu.
     *
     * @param Authenticatable $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function update(Authenticatable $user, Menu $menu)
    {
        if ($user->canDo('menu.menu.edit') && $user->isAdmin()) {
            return true;
        }

        return $menu->user_id == user_id() && $menu->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given menu.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, Menu $menu)
    {
        return $menu->user_id == user_id() && $menu->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given menu.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function verify(Authenticatable $user, Menu $menu)
    {
        if ($user->canDo('menu.menu.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given menu.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function approve(Authenticatable $user, Menu $menu)
    {
        if ($user->canDo('menu.menu.approve')) {
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
