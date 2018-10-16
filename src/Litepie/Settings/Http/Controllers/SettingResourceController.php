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

        if ($this->response->typeIs('json')) {
            $pageLimit = $request->input('pageLimit');
            $data      = $this->repository
                ->setPresenter(\Litepie\Settings\Repositories\Presenter\SettingPresenter::class)
                ->getDataTable($pageLimit);
            return $this->response
                ->data($data)
                ->output();
        }

        $settings = $this->repository->paginate();

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
    public function saveSettings(SettingRequest $request)
    {
        try {
            $attributes = $request->all();

            if (user()->hasRole('superuser')) {

                foreach ($attributes['main'] as $key => $value) {
                    $this->repository->setValue($key, $value);
                }

            }

            foreach ($attributes['user'] as $key => $value) {
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

    /**
     * Remove the setting.
     *
     * @param Model   $setting
     *
     * @return Response
     */
    public function destroy(SettingRequest $request, Setting $setting)
    {
        try {

            $setting->delete();
            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('settings::setting.name')]))
                ->code(202)
                ->status('success')
                ->url(trans_url(guard_url('/settings/setting')))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(trans_url(guard_url('/settings/setting/' . $setting->getRouteKey())))
                ->redirect();
        }

    }

}
