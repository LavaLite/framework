<?php

namespace Litepie\Setting\Actions;

use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;
use Litepie\Setting\Models\Setting;
use Litepie\Setting\Scopes\SettingResourceScope;

class SettingActions
{
    use AsAction;
    use LogsActions;

    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(Setting::class);

        $function = Str::camel($action);

        event('setting.setting.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('setting.setting.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;

    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $setting = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new SettingResourceScope())
            ->paginate($pageLimit);

        return $setting;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $setting = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new SettingResourceScope())
            ->simplePaginate($pageLimit);

        return $setting;
    }

    function empty(array $request) {
        return $this->model->forceDelete();
    }

    function restore(array $request) {
        return $this->model->restore();
    }

    public function delete(array $request)
    {
        $ids = $request['ids'];
        $ids = collect($ids)->map(function ($id) {
            return hashids_decode($id);
        });
        return $this->model->whereIn('id', $ids)->delete();
    }
    
    public function get($key, $default = null)
    {
        return settings()->get($key, $default);
    }

    public function set($arr)
    {
        return settings()->set($arr);
    }

    public function getForUser($key, $default = null)
    {
        $row = $this->model->scopeQuery(function ($query) use ($key) {
            return $query->where('key', $key)
                ->whereUserId(user_id())
                ->whereUserType(user_type());
        })->first();

        if (!empty($row)) {
            return $row['value'];
        }

        return $default;
    }

    public function setForuser($arr)
    {
        return $this->model->updateOrCreate(
            [
                'key' => $arr['key'],
                'user_id' => user_id(),
                'user_type' => user_type(),
            ],
            [
                'key' => $arr['key'],
                'user_id' => user_id(),
                'user_type' => user_type(),
                'value' => $arr['value'],
            ]
        );

    }

    /**
     * Upload the file to a specific path.
     *
     * @param Request $request
     * @param string  $key
     *
     * @return void
     */
    public function upload($arr)
    {
        if (isset($arr['request']) && $arr['request']->hasFile($arr['key'] . '[file]')) {
            $path = $arr['request']->get($arr['key'] . "['path']");
            $folder = substr("$path", 0, strrpos($path, '/'));
            $file = substr("$path", (strrpos($path, '_') + 1));
            $res = $arr['request']->file($arr['key']['file'])->storeAs($folder, $file);
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
    public function env($arr)
    {
        $this->setEnvironmentValue($arr);
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

    private function setEnvironmentValue($arr)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = env($arr['key']);
        $str = str_replace("{$arr['key']}={$oldValue}", "{$arr['key']}={$arr['value']}", $str);

        return file_put_contents($envFile, $str);
    }
}
