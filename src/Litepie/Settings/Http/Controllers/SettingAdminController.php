<?php

namespace Litepie\Settings\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\Settings\Http\Requests\SettingRequest;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;
use Litepie\Settings\Models\Setting;

/**
 * Admin web controller class.
 */
class SettingAdminController extends BaseController
{
    // use SettingWorkflow;
    /**
     * Initialize setting controller.
     *
     * @param type SettingRepositoryInterface $setting
     *
     * @return type
     */
    public function __construct(SettingRepositoryInterface $setting)
    {
        $this->repository = $setting;
        parent::__construct();
    }

    /**
     * Display a list of setting.
     *
     * @return Response
     */
    public function index(SettingRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('settings::setting.names').' :: ');
        return $this->theme->of('settings::admin.setting.index')->render();
    }

    /**
     * Display a list of setting.
     *
     * @return Response
     */
    public function getJson(SettingRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $settings  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\Settings\\Repositories\\Presenter\\SettingListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $settings['recordsTotal']    = $settings['meta']['pagination']['total'];
        $settings['recordsFiltered'] = $settings['meta']['pagination']['total'];
        $settings['request']         = $request->all();
        return response()->json($settings, 200);

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
        if (!$setting->exists) {
            return response()->view('settings::admin.setting.new', compact('setting'));
        }

        Form::populate($setting);
        return response()->view('settings::admin.setting.show', compact('setting'));
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

        Form::populate($setting);

        return response()->view('settings::admin.setting.create', compact('setting'));

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
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $setting          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('settings::setting.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/settings/setting/'.$setting->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
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
        Form::populate($setting);
        return  response()->view('settings::admin.setting.edit', compact('setting'));
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

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('settings::setting.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/settings/setting/'.$setting->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/settings/setting/'.$setting->getRouteKey()),
            ], 400);

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

            $t = $setting->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('settings::setting.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/settings/setting/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/settings/setting/'.$setting->getRouteKey()),
            ], 400);
        }
    }

}
