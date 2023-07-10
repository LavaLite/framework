<?php

namespace Litepie\Master\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Master\Actions\MasterAction;
use Litepie\Master\Actions\MasterActions;
use Litepie\Master\Forms\Master as MasterForm;
use Litepie\Master\Http\Requests\MasterResourceRequest;
use Litepie\Master\Http\Resources\MasterResource;
use Litepie\Master\Http\Resources\MastersCollection;
use Litepie\Master\Models\Master;

/**
 * Resource controller class for master.
 */
class MasterResourceController extends BaseController
{

    /**
     * Initialize master resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->form = MasterForm::only('main')
                ->setAttributes()
                ->toArray();

            $this->modules = $this->modules(config('master.modules'), 'master', guard_url('master'));
            return $next($request);
        });
    }

    /**
     * Display a list of master.
     *
     * @return Response
     */
    public function index(MasterResourceRequest $request, $type = null)
    {
        $request = $request->all();
        $page = MasterActions::run('paginate', $request);
        $data = new MastersCollection($page);

        if ($type == null) {
            $view = 'master::master.index';
        } else {
            $view = 'master::master.masters';
        }

        $form = $this->form;
        $modules = $this->modules;
        $count = MasterActions::run('groupcount', $request);
        $groups = MasterActions::run('groups', $request);
        return $this->response->setMetaTitle(trans('master::master.names'))
            ->view($view)
            ->data(compact('type', 'data', 'modules', 'form', 'count', 'groups'))
            ->output();
    }

    /**
     * Display master.
     *
     * @param Request $request
     * @param Model   $master
     *
     * @return Response
     */
    public function show(MasterResourceRequest $request, Master $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new MasterResource($model);
        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('master.master.name'))
            ->data(compact('data', 'form', 'modules'))
            ->view('master::master.show')
            ->output();
    }

    /**
     * Show the form for creating a new master.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MasterResourceRequest $request, Master $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new MasterResource($model);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('master.master.name'))
            ->view('master::master.create')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Create new master.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MasterResourceRequest $request, Master $model)
    {
        try {
            $request = $request->all();
            $model = MasterAction::run('store', $model, $request);
            $data = new MasterResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('master.master.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('master/master/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/master/master'))
                ->redirect();
        }

    }

    /**
     * Show master for editing.
     *
     * @param Request $request
     * @param Model   $master
     *
     * @return Response
     */
    public function edit(MasterResourceRequest $request, Master $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new MasterResource($model);
        // return view('master::master.edit', compact('data', 'form', 'modules'));

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('master.master.name'))
            ->view('master::master.edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Update the master.
     *
     * @param Request $request
     * @param Model   $master
     *
     * @return Response
     */
    public function update(MasterResourceRequest $request, Master $model)
    {
        try {
            $request = $request->all();
            $model = MasterAction::run('update', $model, $request);
            $data = new MasterResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('master.master.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('master/master/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('master/master/' . $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the master.
     *
     * @param Model   $master
     *
     * @return Response
     */
    public function destroy(MasterResourceRequest $request, Master $model)
    {
        try {

            $request = $request->all();
            $model = MasterAction::run('delete', $model, $request);
            $data = new MasterResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('master.master.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('master/master/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('master/master/' . $model->getRouteKey()))
                ->redirect();
        }

    }
}
