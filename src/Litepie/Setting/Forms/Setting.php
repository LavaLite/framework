<?php

namespace Litepie\Setting\Forms;

use Litepie\Form\FormInterpreter;

class Setting extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {
        static::$urls = config('setting.setting.urls');
        static::$search = config('setting.setting.search');
        static::$orderBy = config('setting.setting.order');
        static::$groups =  config('setting.setting.groups');
        static::$list =  config('setting.setting.list');
        static::$fields = config('setting.setting.form');

        return new static();
    }


    public static function fields()
    {
        $item = collect(self::$fields)->map(function ($val) {
            $val['label'] = trans($val['label']);
            $val['placeholder'] = trans($val['placeholder']);
            if (isset($val['options']) && is_callable($val['options'])) {
                $val['options'] = call_user_func($val['options']);
            }
            if ($val['setting']['type'] == 'env') {
                $val['value'] = env($val['setting']['key']);
                $val['name'] = 'env['. $val['setting']['key'] .']';
            }
            if ($val['setting']['type'] == 'setting') {
                $val['value'] = settings($val['setting']['key']);
                $val['name'] = 'settings['. $val['setting']['key'] .']';
            }
            return $val;
        });
        if (!self::$grouped) {
            return $item;
        }

        if (self::$grouped === true || self::$grouped == 1) {
            return $item->groupBy(['group'], true);
        }

        if (self::$grouped == 2) {
            return $item->groupBy(['group', 'section'], true);
        }
    }

    public static function groups()
    {
        foreach (self::$groups as $key => $val) {
            self::$groups[$key]['name'] = trans($val['name']);
            self::$groups[$key]['title'] = trans($val['title']);
        }

        return collect(self::$groups)->groupBy(['group'], true)->toArray();
    }

}
