<?php

namespace Litepie\Menu\Policies;

use Litepie\User\Contracts\UserPolicy;
use Litepie\Menu\Models\Menu;

class MenuPolicy
{

    /**
     * Determine if the given user can view the menu.
     *
     * @param UserPolicy $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function view(UserPolicy $user, Menu $menu)
    {
        return false;
    }

    /**
     * Determine if the given user can create a menu.
     *
     * @param UserPolicy $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return false;
    }

    /**
     * Determine if the given user can update the given menu.
     *
     * @param UserPolicy $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function update(UserPolicy $user, Menu $menu)
    {
        return false;

    }

    /**
     * Determine if the given user can delete the given menu.
     *
     * @param UserPolicy $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Menu $menu)
    {

        return false;
    }

    /**
     * Determine if the given user can verify the given menu.
     *
     * @param UserPolicy $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function verify(UserPolicy $user, Menu $menu)
    {
        return false;
    }

    /**
     * Determine if the given user can approve the given menu.
     *
     * @param UserPolicy $user
     * @param Menu $menu
     *
     * @return bool
     */
    public function approve(UserPolicy $user, Menu $menu)
    {
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
        if ($user->isSuperUser()) {
            return true;
        }
    }
}
