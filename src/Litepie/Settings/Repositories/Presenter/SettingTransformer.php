<?php

namespace Litepie\Settings\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class SettingTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Settings\Models\Setting $setting)
    {
        return [
            'id'                => $setting->getRouteKey(),
            'key'               => $setting->key,
            'package'           => $setting->package,
            'module'            => $setting->module,
            'name'              => $setting->name,
            'value'             => $setting->value,
            'file'              => $setting->file,
            'control'           => $setting->control,
            'type'              => $setting->type,
            'status'            => trans('app.'.$setting->status),
            'created_at'        => format_date($setting->created_at),
            'updated_at'        => format_date($setting->updated_at),
        ];
    }
}
