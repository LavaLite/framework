<?php

namespace Litepie\Settings\Workflow;

use Litepie\Settings\Models\Setting;
use Validator;

class SettingValidator
{

    /**
     * Determine if the given setting is valid for complete status.
     *
     * @param Setting $setting
     *
     * @return bool / Validator
     */
    public function complete(Setting $setting)
    {
        return Validator::make($setting->toArray(), [
            'title' => 'required|min:15',
        ]);
    }

    /**
     * Determine if the given setting is valid for verify status.
     *
     * @param Setting $setting
     *
     * @return bool / Validator
     */
    public function verify(Setting $setting)
    {
        return Validator::make($setting->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:complete',
        ]);
    }

    /**
     * Determine if the given setting is valid for approve status.
     *
     * @param Setting $setting
     *
     * @return bool / Validator
     */
    public function approve(Setting $setting)
    {
        return Validator::make($setting->toArray(), [
            'title'  => 'required|min:15',
            'status' => 'in:verify',
        ]);

    }

    /**
     * Determine if the given setting is valid for publish status.
     *
     * @param Setting $setting
     *
     * @return bool / Validator
     */
    public function publish(Setting $setting)
    {
        return Validator::make($setting->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,archive,unpublish',
        ]);

    }

    /**
     * Determine if the given setting is valid for archive status.
     *
     * @param Setting $setting
     *
     * @return bool / Validator
     */
    public function archive(Setting $setting)
    {
        return Validator::make($setting->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:approve,publish,unpublish',
        ]);

    }

    /**
     * Determine if the given setting is valid for unpublish status.
     *
     * @param Setting $setting
     *
     * @return bool / Validator
     */
    public function unpublish(Setting $setting)
    {
        return Validator::make($setting->toArray(), [
            'title'       => 'required|min:15',
            'description' => 'required|min:50',
            'status'      => 'in:publish',
        ]);

    }
}
