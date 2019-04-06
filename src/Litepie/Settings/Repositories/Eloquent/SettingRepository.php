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

    /**
     * Update the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function upload($request, $key)
    {
        dd($request->file('upload.' . $key.'.file'));
        if ($request->hasFile($key."[file]")) {
            $path   = $request->get($key."['path']");
            $folder = substr("$path", 0, strrpos($path, '/'));
            $file   = substr("$path", (strrpos($path, '_') + 1));

            $res = $request->file($key['file'])->storeAs($folder, $file);

            dd($res);
        }

    }

    /**
     * Update the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function theme($value)
    {
        dd($value);
    }

    /**
     * Update the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function env($value)
    {
        dd($value);
    }

    /**
     * Update the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function commands($value)
    {
        dd($value);
    }

}
