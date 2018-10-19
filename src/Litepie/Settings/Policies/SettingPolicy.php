<?php

namespace Litepie\Settings\Policies;

use Litepie\Settings\Models\Setting;
use Litepie\User\Contracts\UserPolicy;

class SettingPolicy
{
    /**
     * Determine if the given user can view the setting.
     *
     * @param UserPolicy $user
     * @param Setting    $setting
     *
     * @return bool
     */
    public function view(UserPolicy $user, Setting $setting)
    {
        if ($user->canDo('settings.setting.view') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $setting->user_id;
    }

    /**
     * Determine if the given user can create a setting.
     *
     * @param UserPolicy $user
     * @param Setting    $setting
     *
     * @return bool
     */
    public function create(UserPolicy $user)
    {
        return  $user->canDo('settings.setting.create');
    }

    /**
     * Determine if the given user can update the given setting.
     *
     * @param UserPolicy $user
     * @param Setting    $setting
     *
     * @return bool
     */
    public function update(UserPolicy $user, Setting $setting)
    {
        if ($user->canDo('settings.setting.update') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $setting->user_id;
    }

    /**
     * Determine if the given user can delete the given setting.
     *
     * @param UserPolicy $user
     * @param Setting    $setting
     *
     * @return bool
     */
    public function destroy(UserPolicy $user, Setting $setting)
    {
        if ($user->canDo('settings.setting.delete') && $user->isAdmin()) {
            return true;
        }

        return $user->id == $setting->user_id;
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
