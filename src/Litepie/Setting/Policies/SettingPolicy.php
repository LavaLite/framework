<?php

namespace Litepie\Setting\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Setting\Models\Setting;

class SettingPolicy
{


    /**
     * Determine if the given user can view the setting.
     *
     * @param UserPolicyInterface $authUser
     * @param Setting $setting
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, Setting $setting)
    {
        if ($authUser->canDo('setting.setting.view') && $authUser->isAdmin()) {
            return true;
        }

        return $setting->user_id == user_id() && $setting->user_type == user_type();
    }

    /**
     * Determine if the given user can create a setting.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function create(UserPolicyInterface $authUser)
    {
        return  $authUser->canDo('setting.setting.create');
    }

    /**
     * Determine if the given user can update the given setting.
     *
     * @param UserPolicyInterface $authUser
     * @param Setting $setting
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, Setting $setting)
    {
        if ($authUser->canDo('setting.setting.edit') && $authUser->isAdmin()) {
            return true;
        }

        return $setting->user_id == user_id() && $setting->user_type == user_type();
    }

    /**
     * Determine if the given user can delete the given setting.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function destroy(UserPolicyInterface $authUser, Setting $setting)
    {
        return $setting->user_id == user_id() && $setting->user_type == user_type();
    }

    /**
     * Determine if the given user can verify the given setting.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function verify(UserPolicyInterface $authUser, Setting $setting)
    {
        if ($authUser->canDo('setting.setting.verify')) {
            return true;
        }

        return false;
    }

    /**
     * Determine if the given user can approve the given setting.
     *
     * @param UserPolicyInterface $authUser
     *
     * @return bool
     */
    public function approve(UserPolicyInterface $authUser, Setting $setting)
    {
        if ($authUser->canDo('setting.setting.approve')) {
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
