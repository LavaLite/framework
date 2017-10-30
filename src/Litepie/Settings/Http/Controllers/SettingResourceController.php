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
                ->setPresenter(\Litepie\Settings\Repositories\Presenter\SettingListPresenter::class)
                ->getDataTable($pageLimit);
            return $this->response
                ->data($data)
                ->output();
        }

        $settings = $this->repository->paginate();

        return $this->response->title(trans('settings::setting.names'))
            ->view('settings::admin.setting.index')
            ->data(compact('settings'))
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
    public function show(SettingRequest $request, Setting $setting)
    {

        if ($setting->exists) {
            $view = 'settings::admin.setting.show';
        } else {
            $view = 'settings::admin.setting.new';
        }

        return $this->response->title(trans('app.view') . ' ' . trans('settings::setting.name'))
            ->data(compact('setting'))
            ->view($view)
            ->output();
    }

    /**
     * Show the form for creating a new setting.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(SettingRequest $request)
    {

        $setting = $this->repository->newInstance([]);
        return $this->response->title(trans('app.new') . ' ' . trans('settings::setting.name')) 
            ->view('settings::admin.setting.create') 
            ->data(compact('setting'))
            ->output();
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
            $attributes              = $request->all();
            $attributes['user_id']   = user_id();
            $attributes['user_type'] = user_type();
            $setting                 = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('settings::setting.name')]))
                ->code(204)
                ->status('success')
                ->url(trans_url(guard_url('/settings/setting/' . $setting->getRouteKey())))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(trans_url(guard_url('/settings/setting')))
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
    public function edit(SettingRequest $request, Setting $setting)
    {
        return $this->response->title(trans('app.edit') . ' ' . trans('settings::setting.name'))
            ->view('settings::admin.setting.edit')
            ->data(compact('setting'))
            ->output();
    }

    /**
     * Update the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        try {
            $attributes = $request->all();

            $setting->update($attributes);
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('settings::setting.name')]))
                ->code(204)
                ->status('success')
                ->url(trans_url(guard_url('/settings/setting/' . $setting->getRouteKey())))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/settings/setting/' . $setting->getRouteKey()))
                ->redirect();
        }

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

    /**
     * Remove multiple setting.
     *
     * @param Model   $setting
     *
     * @return Response
     */
    public function delete(SettingRequest $request, $type)
    {
        try {
            $ids = hashids_decode($request->input('ids'));

            if ($type == 'purge') {
                $this->repository->purge($ids);
            } else {
                $this->repository->delete($ids);
            }

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('settings::setting.name')]))
                ->status("success")
                ->code(202)
                ->url(trans_url(guard_url('/settings/setting')))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(trans_url(guard_url('/settings/setting')))
                ->redirect();
        }

    }

    /**
     * Restore deleted settings.
     *
     * @param Model   $setting
     *
     * @return Response
     */
    public function restore(SettingRequest $request)
    {
        try {
            $ids = hashids_decode($request->input('ids'));
            $this->repository->restore($ids);

            return $this->response->message(trans('messages.success.restore', ['Module' => trans('settings::setting.name')]))
                ->status("success")
                ->code(202)
                ->url(trans_url(guard_url('/settings/setting')))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(trans_url(guard_url('/settings/setting/')))
                ->redirect();
        }

    }

}