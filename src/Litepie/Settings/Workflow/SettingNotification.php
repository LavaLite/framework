<?php

namespace Litepie\Settings\Workflow;

use Litepie\Settings\Models\Setting;
use Litepie\Settings\Notifications\Setting as SettingNotifyer;
use Notification;

class SettingNotification
{

    /**
     * Send the notification to the users after complete.
     *
     * @param Setting $setting
     *
     * @return void
     */
    public function complete(Setting $setting)
    {
        return Notification::send($setting->user, new SettingNotifyer($setting, 'complete'));;
    }

    /**
     * Send the notification to the users after verify.
     *
     * @param Setting $setting
     *
     * @return void
     */
    public function verify(Setting $setting)
    {
        return Notification::send($setting->user, new SettingNotifyer($setting, 'verify'));;
    }

    /**
     * Send the notification to the users after approve.
     *
     * @param Setting $setting
     *
     * @return void
     */
    public function approve(Setting $setting)
    {
        return Notification::send($setting->user, new SettingNotifyer($setting, 'approve'));;

    }

    /**
     * Send the notification to the users after publish.
     *
     * @param Setting $setting
     *
     * @return void
     */
    public function publish(Setting $setting)
    {
        return Notification::send($setting->user, new SettingNotifyer($setting, 'publish'));;
    }

    /**
     * Send the notification to the users after archive.
     *
     * @param Setting $setting
     *
     * @return void
     */
    public function archive(Setting $setting)
    {
        return Notification::send($setting->user, new SettingNotifyer($setting, 'archive'));;

    }

    /**
     * Send the notification to the users after unpublish.
     *
     * @param Setting $setting
     *
     * @return void
     */
    public function unpublish(Setting $setting)
    {
        return Notification::send($setting->user, new SettingNotifyer($setting, 'unpublish'));;

    }
}
