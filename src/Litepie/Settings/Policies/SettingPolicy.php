<?php

namespace Litepie\Settings\Policies;

use Litepie\User\Interfaces\UserPolicyInterface;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;

class SettingPolicy
{

    /**
     * Determine if the given user can view the setting.
     *
     * @param UserPolicyInterface $authUser
     * @param SettingRepositoryInterface $setting
     *
     * @return bool
     */
    public function view(UserPolicyInterface $authUser, SettingRepositoryInterface $setting)
    {
        if ($authUser->canDo('settings.setting.view')) {
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
        return  $authUser->canDo('settings.setting.create');
    }

    /**
     * Determine if the given user can update the given setting.
     *
     * @param UserPolicyInterface $authUser
     * @param SettingRepositoryInterface $setting
     *
     * @return bool
     */
    public function update(UserPolicyInterface $authUser, SettingRepositoryInterface $setting)
    {
        if ($authUser->canDo('settings.setting.edit')) {
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
    public function destroy(UserPolicyInterface $authUser, SettingRepositoryInterface $setting)
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
    public function verify(UserPolicyInterface $authUser, SettingRepositoryInterface $setting)
    {
        if ($authUser->canDo('settings.setting.verify')) {
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
    public function approve(UserPolicyInterface $authUser, SettingRepositoryInterface $setting)
    {
        if ($authUser->canDo('settings.setting.approve')) {
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
