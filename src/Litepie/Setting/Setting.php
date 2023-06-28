<?php

namespace Litepie\Setting;

use Litepie\Setting\Models\Setting as ModelSetting;

class Setting
{
    var $setting = null;

    /**
     * Constructor.
     */
    public function __construct(
    ) {
        $this->setting = app(ModelSetting::class);
    }

    /*
    Get and set the value of settings table
     */
    public function setting($value, $default = null)
    {
        if (is_array($value)) {
            $key = array_key_first($value);
            $val = $value[$key];

            return $this->setForUser($key, $val);
        } else {
            $ret = $this->getForUser($value);
            if (is_null($ret)) {
                $ret = $this->getValue($value, $default);
            }
            return $ret;
        }
    }

    public function get($key, $default = null)
    {
        return $this->getValue($key, $default);
    }

    public function set($key, $value)
    {
        return $this->setValue($key, $value);
    }


    public function user($key, $default = null)
    {
        if (is_array($key)) {
            $this->setForUser(key($key), value($key));

            return value($key);
        }

        return $this->getForuser($key, $default);
    }



    public function getValue($key, $default = null)
    {
        $row = $this->setting->where('key', $key)
            ->first();

        if (!empty($row)) {
            $row = $row->toArray();
            return $row['value'];
        }

        return $default;
    }

    public function setValue($key, $value)
    {
        $setting = $this->setting->updateOrCreate(
            [
                'key' => $key,
            ],
            [
                'value'     => $value,
                'key'       => $key,
                'user_type' => 'main',
            ]
        );

        return $setting;
    }

    public function getForUser($key, $default = null)
    {
        $row = $this->setting->scopeQuery(function ($query) use ($key) {
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
        $setting = $this->setting->updateOrCreate(
            [
                'key'       => $key,
                'user_id'   => user_id(),
                'user_type' => user_type(),
            ],
            [
                'key'       => $key,
                'user_id'   => user_id(),
                'user_type' => user_type(),
                'value'     => $value,
            ]
        );

        return $setting;
    }

    /**
     * Upload the file to a specific path.
     *
     * @param Request $request
     * @param string  $key
     *
     * @return void
     */
    public function upload($request, $key)
    {
        if ($request->hasFile($key.'[file]')) {
            $path = $request->get($key."['path']");
            $folder = substr("$path", 0, strrpos($path, '/'));
            $file = substr("$path", (strrpos($path, '_') + 1));
            $res = $request->file($key['file'])->storeAs($folder, $file);
        }
    }

    /**
     * Set theme variable.
     *
     * @param string $request
     * @param string $key
     * @param string $value
     *
     * @return void
     */
    public function theme($theme, $key, $value)
    {
        // Todo: Update the theme config variable.
    }

    /**
     * Update the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function env($key, $value)
    {
        $this->setEnvironmentValue($key, $value);
    }

    /**
     * Execute commands.
     *
     * @param string $string
     * @param string $value
     *
     * @return void
     */
    public function commands($string, $value)
    {
        // Todo: Execute the command string based on value.
    }

    private function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = env($envKey);
        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);

        return file_put_contents($envFile, $str);
    }
}
