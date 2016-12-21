<?php

namespace Litepie\Settings\Http\Controllers\Api;

use App\Http\Controllers\Api\AdminController as BaseController;
use Litepie\Settings\Http\Requests\SettingRequest;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;
use Litepie\Settings\Models\Setting;

/**
 * Admin API controller class.
 */
class SettingAdminController extends BaseController
{
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
     * @return json
     */
    public function index(SettingRequest $request)
    {
        $settings  = $this->repository
            ->setPresenter('\\Litepie\\Settings\\Repositories\\Presenter\\SettingListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->all();
        $settings['code'] = 2000;
        return response()->json($settings) 
                         ->setStatusCode(200, 'INDEX_SUCCESS');

    }

    /**
     * Display setting.
     *
     * @param Request $request
     * @param Model   Setting
     *
     * @return Json
     */
    public function show(SettingRequest $request, Setting $setting)
    {
        $setting         = $setting->presenter();
        $setting['code'] = 2001;
        return response()->json($setting)
                         ->setStatusCode(200, 'SHOW_SUCCESS');;

    }

    /**
     * Show the form for creating a new setting.
     *
     * @param Request $request
     *
     * @return json
     */
    public function create(SettingRequest $request, Setting $setting)
    {
        $setting         = $setting->presenter();
        $setting['code'] = 2002;
        return response()->json($setting)
                         ->setStatusCode(200, 'CREATE_SUCCESS');

    }

    /**
     * Create new setting.
     *
     * @param Request $request
     *
     * @return json
     */
    public function store(SettingRequest $request)
    {
        try {
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.api');
            $setting          = $this->repository->create($attributes);
            $setting          = $setting->presenter();
            $setting['code']  = 2004;

            return response()->json($setting)
                             ->setStatusCode(201, 'STORE_SUCCESS');
        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4004,
            ])->setStatusCode(400, 'STORE_ERROR');
        }
    }

    /**
     * Show setting for editing.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return json
     */
    public function edit(SettingRequest $request, Setting $setting)
    {
        $setting         = $setting->presenter();
        $setting['code'] = 2003;
        return response()-> json($setting)
                        ->setStatusCode(200, 'EDIT_SUCCESS');;
    }

    /**
     * Update the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return json
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        try {

            $attributes = $request->all();

            $setting->update($attributes);
            $setting         = $setting->presenter();
            $setting['code'] = 2005;

            return response()->json($setting)
                             ->setStatusCode(201, 'UPDATE_SUCCESS');


        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4005,
            ])->setStatusCode(400, 'UPDATE_ERROR');

        }
    }

    /**
     * Remove the setting.
     *
     * @param Request $request
     * @param Model   $setting
     *
     * @return json
     */
    public function destroy(SettingRequest $request, Setting $setting)
    {
        try {
            $t = $setting->delete();

            return response()->json([
                'message'  => trans('messages.success.delete', ['Module' => trans('settings::setting.name')]),
                'code'     => 2006
            ])->setStatusCode(202, 'DESTROY_SUCCESS');

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 4006,
            ])->setStatusCode(400, 'DESTROY_ERROR');
        }
    }
}
