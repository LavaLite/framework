<?php

namespace Litepie\Settings;

use Litepie\Settings\Interfaces\SettingRepositoryInterface;

class Settings
{
    /**
     * $setting object.
     */
    protected $setting;

    /**
     * Constructor.
     */
    public function __construct(SettingRepositoryInterface $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Returns count of settings.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count()
    {
        return 0;
    }

    public function get($key, $default = null, $foruser = false)
    {
        $row = $this->setting->scopeQuery(function ($query) use ($key) {
            return $query->whereKey($key)->orderBy('type', 'DESC');
        })->first();

        if (!empty($row)) {
            return $row['value'];
        }

        return $default;
    }

    public function set($key, $value, $foruser = false)
    {
        $data                = $this->model->findByField('key', $key)->first();
        $attributes['value'] = $value;
        $attributes['key']   = $key;

        if ($foruser) {
            $attributes['user_id']   = user_id();
            $attributes['user_type'] = user_type();
        }

        if (!empty($data)) {
            return $this->model->update(["value" => $value], $data->getRouteKey());
        }

        return $this->model->create($attributes);
    }
    
    public function display($view)
    {
        return view('settings::admin.setting.' . $view);
    }
}
