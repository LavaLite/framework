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

    public function get($key, $default = null)
    {
        return $this->setting->getValue($key, $default);
    }

    public function set($key, $value)
    {
        return $this->setting->setValue($key, $value);
    }

    public function getForUser($key, $default = null)
    {
        return $this->setting->getForUser($key, $default);
    }

    public function setForUser($key, $value)
    {
        return $this->setting->setForUser($key, $value);
    }

    public function user($key, $default = null)
    {
        if (is_array($key)) {
            $this->setForUser(key($key), value($key));

            return value($key);
        }

        return $this->getForuser($key, $default);
    }
}
