<?php

namespace Litepie\Setting\Http\Controllers;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Setting\Actions\SettingActions;
use Litepie\Setting\Forms\Setting as SettingForm;
use Litepie\Setting\Http\Requests\SettingResourceRequest;

/**
 * Resource controller class for setting.
 */
class SettingResourceController extends BaseController
{
    /**
     * Initialize setting resource controller.
     *
     * @return null
     */
    public static function middleware(): array
    {
        return array_merge(
            parent::middleware(),
            [
                function (Request $request, Closure $next) {
                    self::$form = SettingForm::setAttributes()
                        ->toArray();
                    self::$modules = self::modules(config('setting.modules'), 'setting', guard_url('setting'));

                    return $next($request);
                },
            ]
        );
    }

    /**
     * Display a list of setting.
     *
     * @return Response
     */
    public function index(SettingResourceRequest $request)
    {
        $form = self::$form;
        $modules = self::$modules;

        return self::$response->setMetaTitle(trans('setting::setting.names'))
            ->view('setting::index')
            ->data(compact('modules', 'form'))
            ->output();
    }

    /**
     * Display setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function show($group)
    {
        $groups = explode('.', $group)[0];
        self::$form['groups'] = Arr::get(self::$form['groups'], $groups.'.groups');
        self::$form['fields'] = Arr::get(Arr::undot(self::$form['fields']), $group);
        $form = self::$form;

        return self::$response->setMetaTitle(trans('setting::setting.names'))
            ->view('setting::partial.show')
            ->data(compact('form', 'group'))
            ->output();
    }

    /**
     * Create new setting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(SettingResourceRequest $request, $type)
    {
        try {
            $attributes = $request->all();
            if (user()->hasRole('superuser')) {
                if (isset($attributes['settings']) && is_array($attributes['settings'])) {
                    SettingActions::run('set', $attributes['settings']);
                }

                if (isset($attributes['env']) && is_array($attributes['env'])) {
                    foreach ($attributes['env'] as $key => $value) {
                        SettingActions::run('env', ['key' => $key, 'value' => $value]);
                    }
                }

                if (isset($attributes['upload']) && is_array($attributes['upload'])) {
                    foreach ($attributes['upload'] as $key => $value) {
                        SettingActions::run('upload', [['request' => $request, 'key' => $key, 'value' => $value]]);
                    }
                }
            }

            if (isset($attributes['user']) && is_array($attributes['user'])) {
                foreach ($attributes['user'] as $key => $value) {
                    SettingActions::run('setForuser', ['key' => $key, 'value' => $value]);
                }
            }

            return self::$response->message(trans('messages.success.updated', ['Module' => trans('setting::setting.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url("/setting/setting/$type"))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url("/setting/setting/$type"))
                ->redirect();
        }
    }

    /**
     * Show setting for editing.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function getValue($key, $default = null)
    {
        return SettingActions::run('getValue', [$key => $default]);
    }
}
