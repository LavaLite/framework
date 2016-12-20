<?php

namespace Litepie\Settings\Policies;

use App\User;
use Litepie\Settings\Models\Setting;

class SettingPolicy
{

    /**
     * Determine if the given user can view the setting.
     *
     * @param User $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function view(User $user, Setting $setting)
    {
        if ($user->canDo('settings.setting.view') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.view') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $setting->user_id;
    }

    /**
     * Determine if the given user can create a setting.
     *
     * @param User $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function create(User $user)
    {
        return  $user->canDo('settings.setting.create');
    }

    /**
     * Determine if the given user can update the given setting.
     *
     * @param User $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function update(User $user, Setting $setting)
    {
        if ($user->canDo('settings.setting.update') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.update') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $setting->user_id;
    }

    /**
     * Determine if the given user can delete the given setting.
     *
     * @param User $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function destroy(User $user, Setting $setting)
    {
        if ($user->canDo('settings.setting.delete') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('blocks.block.delete') 
        && $user->is('manager')
        && $block->user->parent_id == $user->id) {
            return true;
        }

        return $user->id === $setting->user_id;
    }

    /**
     * Determine if the given user can verify the given setting.
     *
     * @param User $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function verify(User $user, Setting $setting)
    {
        if ($user->canDo('settings.setting.verify') && $user->is('admin')) {
            return true;
        }

        if ($user->canDo('settings.setting.verify') 
        && $user->is('manager')
        && $setting->user->parent_id == $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given setting.
     *
     * @param User $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function approve(User $user, Setting $setting)
    {
        if ($user->canDo('settings.setting.approve') && $user->is('admin')) {
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
        if ($user->isSuperUser()) {
            return true;
        }
    }
}
