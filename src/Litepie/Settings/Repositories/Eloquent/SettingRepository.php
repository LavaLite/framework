<?php

namespace Litepie\Settings\Repositories\Eloquent;

use Litepie\Repository\BaseRepository;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{
    public function boot()
    {
        $this->fieldSearchable = config('setting.setting.model.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('setting.setting.model.model');
    }

    public function getValue($key, $default = null)
    {
        $row = $this->where('key', $key)
            ->first()
            ->toArray();

        if (!empty($row)) {
            return $row['value'];
        }

        return $default;
    }

    public function setValue($key, $value)
    {
        $setting = $this->updateOrCreate(
            [
                'key' => $key,
            ],
            [
                'value'     => $value,
                'key'       => $key,
                'user_type' => 'main',
            ]
        );

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
        $setting = $this->updateOrCreate(
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

        return $value;
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
