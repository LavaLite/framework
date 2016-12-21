<?php

namespace Litepie\Settings\Workflow;

use Exception;
use Litepie\Workflow\Exceptions\WorkflowActionNotPerformedException;

use Litepie\Settings\Models\Setting;

class SettingAction
{
    /**
     * Perform the complete action.
     *
     * @param Setting $setting
     *
     * @return Setting
     */
    public function complete(Setting $setting)
    {
        try {
            $setting->status = 'complete';
            return $setting->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the verify action.
     *
     * @param Setting $setting
     *
     * @return Setting
     */public function verify(Setting $setting)
    {
        try {
            $setting->status = 'verify';
            return $setting->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the approve action.
     *
     * @param Setting $setting
     *
     * @return Setting
     */public function approve(Setting $setting)
    {
        try {
            $setting->status = 'approve';
            return $setting->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the publish action.
     *
     * @param Setting $setting
     *
     * @return Setting
     */public function publish(Setting $setting)
    {
        try {
            $setting->status = 'publish';
            return $setting->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the archive action.
     *
     * @param Setting $setting
     *
     * @return Setting
     */
    public function archive(Setting $setting)
    {
        try {
            $setting->status = 'archive';
            return $setting->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }

    /**
     * Perform the unpublish action.
     *
     * @param Setting $setting
     *
     * @return Setting
     */
    public function unpublish(Setting $setting)
    {
        try {
            $setting->status = 'unpublish';
            return $setting->save();
        } catch (Exception $e) {
            throw new WorkflowActionNotPerformedException();
        }
    }
}
