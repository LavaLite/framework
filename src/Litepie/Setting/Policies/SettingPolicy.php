<?php

namespace Litepie\Setting\Policies;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Litepie\Setting\Models\Setting;

class SettingPolicy
{


    /**
     * Determine if the given user can view the setting.
     *
     * @param Authenticatable $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function view(Authenticatable $user, Setting $setting)
    {
        if ($user->canDo('setting.setting.view') && $user->isAdmin()) {
            return true;
        }

        return $setting->user_id == user_id() && $setting->user_type == user_type();
    }

    /**
     * Determine if the given user can create a setting.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function create(Authenticatable $user)
    {
        return  $user->canDo('setting.setting.create');
    }

    /**
     * Determine if the given user can update the given setting.
     *
     * @param Authenticatable $user
     * @param Setting $setting
     *
     * @return bool
     */
    public function update(Authenticatable $user, Setting $setting)
    {
        if ($user->canDo('setting.setting.edit') && $user->isAdmin()) {
            return true;
        }

        return $setting->user_id == user_id() && $setting->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given setting.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function destroy(Authenticatable $user, Setting $setting)
    {
        return $setting->user_id == user_id() && $setting->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given setting.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function verify(Authenticatable $user, Setting $setting)
    {
        if ($user->canDo('setting.setting.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given setting.
     *
     * @param Authenticatable $user
     *
     * @return bool
     */
    public function approve(Authenticatable $user, Setting $setting)
    {
        if ($user->canDo('setting.setting.approve')) {
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
