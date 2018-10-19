<?php

namespace Litepie\Settings\Repositories\Eloquent;

use Litepie\Repository\Eloquent\BaseRepository;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function boot()
    {
        $this->fieldSearchable = config('settings.setting.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('settings.setting.model');
    }

    public function getValue($key, $default = null)
    {
        $row = $this->scopeQuery(function ($query) use ($key) {
            return $query
                ->whereNull('user_id')
                ->where('key', $key);
        })->first();

        if (!empty($row)) {
            return $row['value'];
        }

        return $default;
    }

    public function setValue($key, $value)
    {
        $setting = $this->firstOrCreate(
            [
                'key' => $key,
            ]
        );

        $setting->value = $value;
        $setting->save();

        return $value;
    }

    public function getForUser($key, $default = null)
    {
        $row = $this->scopeQuery(function ($query) use ($key) {
            return $query->where('key', $key)
                ->whereUserId(user_id())
                ->whereUserType(user_type());
        })->first();

        if (!empty($row)) {
            return $row['value'];
        }

        return $default;
    }

    public function setForuser($key, $value)
    {
        $setting = $this->firstOrCreate(
            [
                'key'       => $key,
                'user_id'   => user_id(),
                'user_type' => user_type(),
            ]
        );
        $setting->value = $value;
        $setting->save();

        return $value;
    }
}
