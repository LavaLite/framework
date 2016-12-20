<?php

namespace Litepie\Settings\Http\Controllers;

use App\Http\Controllers\UserController as BaseController;
use Form;
use Litepie\Settings\Http\Requests\SettingRequest;
use Litepie\Settings\Interfaces\SettingRepositoryInterface;
use Litepie\Settings\Models\Setting;

class SettingUserController extends BaseController
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(SettingRequest $request)
    {
        $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new \Lavalite\Settings\Repositories\Criteria\SettingUserCriteria());
        $settings = $this->repository->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        $this->theme->prependTitle(trans('settings::setting.names').' :: ');

        return $this->theme->of('settings::user.setting.index', compact('settings'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Setting $setting
     *
     * @return Response
     */
    public function show(SettingRequest $request, Setting $setting)
    {
        Form::populate($setting);

        return $this->theme->of('settings::user.setting.show', compact('setting'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(SettingRequest $request)
    {

        $setting = $this->repository->newInstance([]);
        Form::populate($setting);

        return $this->theme->of('settings::user.setting.create', compact('setting'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(SettingRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $setting = $this->repository->create($attributes);

            return redirect(trans_url('/user/settings/setting'))
                -> with('message', trans('messages.success.created', ['Module' => trans('settings::setting.name')]))
                -> with('code', 201);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Setting $setting
     *
     * @return Response
     */
    public function edit(SettingRequest $request, Setting $setting)
    {

        Form::populate($setting);

        return $this->theme->of('settings::user.setting.edit', compact('setting'))->render();
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param Setting $setting
     *
     * @return Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        try {
            $this->repository->update($request->all(), $setting->getRouteKey());

            return redirect(trans_url('/user/settings/setting'))
                ->with('message', trans('messages.success.updated', ['Module' => trans('settings::setting.name')]))
                ->with('code', 204);

        } catch (Exception $e) {
            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(SettingRequest $request, Setting $setting)
    {
        try {
            $this->repository->delete($setting->getRouteKey());
            return redirect(trans_url('/user/settings/setting'))
                ->with('message', trans('messages.success.deleted', ['Module' => trans('settings::setting.name')]))
                ->with('code', 204);

        } catch (Exception $e) {

            redirect()->back()->withInput()->with('message', $e->getMessage())->with('code', 400);

        }
    }
}
