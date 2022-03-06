<?php

namespace Litepie\Settings;

use Litepie\Settings\Interfaces\SettingRepositoryInterface;

class Settings
{
    /**
     * Constructor.
     */
    public function __construct(
        SettingRepositoryInterface $setting
    ) {
        $this->setting = $setting;
    }

    /*
    Get and set the value of settings table
     */
    public function setting($value, $default = null)
    {
        if (is_array($value)) {
            $key = array_key_first($value);
            $val = $value[$key];

            return $this->setting->setForUser($key, $val);
        } elseif (is_array($value)) {
            $ret = $this->setting->getForUser($key);
            if (is_null($ret)) {
                $ret = $this->setting->getValue($key, $default);
            }
        }
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
