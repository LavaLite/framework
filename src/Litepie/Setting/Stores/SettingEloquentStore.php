<?php

namespace Litepie\Setting\Stores;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;

class SettingEloquentStore implements SettingStore
{
    /**
     * Group name.
     *
     * @var string
     */
    protected $settingsGroupName = 'default';

    /**
     * Cache key.
     *
     * @var string
     */
    protected $settingsCacheKey = 'app.settings';

    /**
     * Cache key.
     *
     * @var string
     */
    protected $casts = [];

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        $this->casts = config('setting.setting.model.casts');
    }

    /**
     * {@inheritdoc}
     */
    public function all($fresh = false)
    {
        if ($fresh) {
            return $this->modelQuery()->pluck('value', 'name');
        }

        return Cache::rememberForever($this->getSettingsCacheKey(), function () {
            return $this->modelQuery()->pluck('value', 'name');
        });
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null, $fresh = false)
    {
        if (!in_array($key, $this->casts)) {
            return $this->all($fresh)->get($key, $default);
        }

        if ($this->casts[$key] == 'array') {
            return json_decode($this->all($fresh)->get($key, $default));
        }

    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $val = null)
    {
        // if its an array, batch save settings
        if (is_array($key)) {
            foreach ($key as $name => $value) {
                $this->set($name, $value);
            }
            return true;
        }

        $setting = $this->getSettingModel()->firstOrNew([
            'name' => $key,
            'group' => $this->settingsGroupName,
        ]);
        $setting->value = $val;
        if (isset($this->casts[$key]) && $this->casts[$key] == 'array') {
            $setting->value = json_encode($val);
        }
        $setting->group = $this->settingsGroupName;
        $setting->save();

        $this->flushCache();

        return $val;
    }

    /**
     * {@inheritdoc}
     */
    public function has($key)
    {
        return $this->all()->has($key);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        $deleted = $this->getSettingModel()->where('name', $key)->delete();

        $this->flushCache();

        return $deleted;
    }

    /**
     * {@inheritdoc}
     */
    public function flushCache()
    {
        return Cache::forget($this->getSettingsCacheKey());
    }

    /**
     * Get settings cache key.
     *
     * @return string
     */
    protected function getSettingsCacheKey()
    {
        return $this->settingsCacheKey . '.' . $this->settingsGroupName;
    }

    /**
     * Get settings eloquent model.
     *
     * @return Builder
     */
    protected function getSettingModel()
    {
        return app(config('setting.setting.model.model'));
    }

    /**
     * Get the model query builder.
     *
     * @return Builder
     */
    protected function modelQuery()
    {
        return $this->getSettingModel()->group($this->settingsGroupName);
    }

    /**
     * Set the group name for settings.
     *
     * @param  string  $groupName
     * @return $this
     */
    public function group($groupName)
    {
        $this->settingsGroupName = $groupName;

        return $this;
    }
}
