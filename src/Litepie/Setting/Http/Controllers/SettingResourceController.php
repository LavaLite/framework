<?php

namespace Litepie\Setting\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Setting\Actions\SettingActions;
use Litepie\Setting\Forms\Setting as SettingForm;
use Litepie\Setting\Http\Requests\SettingResourceRequest;
use Litepie\Setting\Models\Setting;

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
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->form = SettingForm::only('main')
                ->setAttributes()
                ->toArray();
            $this->modules = $this->modules(config('setting.modules'), 'setting', guard_url('setting'));
            return $next($request);
        });
    }

    /**
     * Display a list of setting.
     *
     * @return Response
     */
    public function index(SettingResourceRequest $request)
    {

        $form = $this->form;
        dd($form);
        $modules = $this->modules;
        return $this->response->setMetaTitle(trans('setting::setting.names'))
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
    public function show($type)
    {
        $this->form['fields'] = $this->form['fields'][$type] ?? [];
        $form = $this->form;

        return $this->response->setMetaTitle(trans('setting::setting.names'))
            ->view('setting::partial.show')
            ->data(compact('form', 'type'))
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

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('setting::setting.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url("/setting/setting/$type"))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
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
