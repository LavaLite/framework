<?php

namespace Litepie\Menu\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Menu\Models\Menu;

class MenuPolicy
{


    /**
     * Determine if the given user can view the menu.
     *
     * @param UserPolicyInterface $authUser
     * @param Menu $menu
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Menu $menu)
    {
        if ($authUser->canDo('menu.menu.view') && $authUser->isAdmin()) {
            return true;
        }

        return $menu->user_id == user_id() && $menu->user_type == user_type();
    }

    /**
     * Determine if the given user can create a menu.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('menu.menu.create');
    }

    /**
     * Determine if the given user can update the given menu.
     *
     * @param UserPolicyInterface $authUser
     * @param Menu $menu
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Menu $menu)
    {
        if ($authUser->canDo('menu.menu.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $menu->user_id == user_id() && $menu->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given menu.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Menu $menu)
    {
        return $menu->user_id == user_id() && $menu->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given menu.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, Menu $menu)
    {
        if ($authUser->canDo('menu.menu.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given menu.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, Menu $menu)
    {
        if ($authUser->canDo('menu.menu.approve')) {
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
