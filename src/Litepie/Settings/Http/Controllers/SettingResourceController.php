<?php

namespace Litepie\Settings\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Litepie\Settings\Http\Requests\SettingRequest;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;
use Litepie\Settings\Models\Setting;

/**
 * Resource controller class for setting.
 */
class SettingResourceController extends BaseController
{
    /**
     * Initialize setting resource controller.
     *
     * @param type SettingRepositoryInterface $setting
     *
     * @return null
     */
    public function __construct(SettingRepositoryInterface $setting)
    {
        parent::__construct();
        $this->repository = $setting;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class);
    }

    /**
     * Display a list of setting.
     *
     * @return Response
     */
    public function index(SettingRequest $request)
    {
        return $this->response->setMetaTitle(trans('settings::setting.names'))
            ->view('settings::admin.setting.index')
            ->data(compact('settings'))
            ->output();
    }

    /**
     * Create new setting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function show($slug)
    {
        return view('settings::admin.setting.partial.' . $slug);
    }

    /**
     * Create new setting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(SettingRequest $request)
    {
        try {
            $attributes = $request->all();

            if (user()->hasRole('superuser')) {

                if (isset($attributes['settings']) && is_array($attributes['settings'])) {

                    foreach ($attributes['settings'] as $key => $value) {
                        $this->repository->setValue($key, $value);
                    }

                }

                if (isset($attributes['upload']) && is_array($attributes['upload'])) {

                    foreach ($attributes['upload'] as $key => $value) {
                        $this->repository->upload($request, $key);
                    }

                }

// foreach ($attributes['env'] as $value) {

//     $this->repository->env($value);

// }

// foreach ($attributes['theme'] as $value) {

//     $this->repository->theme($value);
                // }
            }

            foreach ($attributes['settings'] as $key => $value) {
                $this->repository->setForuser($key, $value);
            }

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('settings::setting.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('/settings/setting/'))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/settings/setting'))
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
        return $this->repository->getValue($key, $default = null);
    }

    /**
     * Update the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function setValue($key, $value)
    {
        return $this->repository->setValue($key, $value);
    }

}
