<?php

namespace Litepie\Master\Http\Controllers;

use Litepie\Http\Controllers\ResourceController as BaseController;
use Form;
use Illuminate\Support\Str;
use Litepie\Master\Http\Requests\MasterRequest;
use Litepie\Master\Interfaces\MasterRepositoryInterface;
use Litepie\Master\Models\Master;

/**
 * Resource controller class for master.
 */
class MasterResourceController extends BaseController
{

    /**
     * Initialize master resource controller.
     *
     * @param type MasterRepositoryInterface $master
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->repository = app()->make(MasterRepositoryInterface::class);
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\Master\Repositories\Criteria\MasterResourceCriteria::class);

    }

    /**
     * Display a list of master.
     *
     * @return Response
     */
    public function index(MasterRequest $request, $group = 'masters', $type = null)
    {

        if ($this->response->typeIs('json')) {
            return $this->repository
                ->setPresenter(\Litepie\Master\Repositories\Presenter\MasterPresenter::class)
                ->paginate();
        }

        if ($type == null) {
            $view = 'master::admin.masters';
        } else {
            $view = 'master::index';
        }

        $masters = $this->repository->paginate();
        $count = $this->repository->typeCount();
        $groups = $this->repository->groups();
        $mode = 'list';

        return $this->response->setMetaTitle(trans('master::master.names'))
            ->view($view)
            ->data(compact('masters', 'group', 'groups', 'type', 'count', 'mode'))
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
    public function show(MasterRequest $request, $group, $type, Master $master)
    {
        if ($master->exists) {
            $view = 'master::show';
        } else {
            $view = 'master::new';
        }
        $parents = $this->repository->options($type)->toArray();

        return $this->response->setMetaTitle(trans('app.view') . ' ' . trans('master::master.name'))
            ->data(compact('master', 'group', 'type', 'parents'))
            ->view($view)
            ->output();
    }

    /**
     * Show the form for creating a new master.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MasterRequest $request, $group, $type)
    {
        $master = $this->repository->newInstance([]);
        $parent_id = $request->get('parent_id', 0);
        $parents = $this->repository->options($type, $parent_id)->toArray();

        return $this->response->title(trans('app.new') . ' ' . trans('master::master.name'))
            ->view('master::create')
            ->data(compact('master', 'group', 'type', 'parents'))
            ->output();
    }

    /**
     * Create new master.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MasterRequest $request, $group, $type)
    {
        try {
            $attributes = $request->all();
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $attributes['type'] = $type;

            $master = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('master::master.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url("masters/{$group}/{$type}/master/" . $master->getRouteKey()))
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
    public function edit(MasterRequest $request, $group, $type, Master $master)
    {
        $parents = $this->repository->options($type)->toArray();

        return $this->response->title(trans('app.edit') . ' ' . trans('master::master.name'))
            ->view("master::edit")
            ->data(compact('master', 'group', 'type', 'parents'))
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
    public function update(MasterRequest $request, $group, $type, Master $master)
    {
        try {
            $attributes = $request->all();

            $master->update($attributes);
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('master::master.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url("masters/{$group}/{$type}/master/" . $master->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url("masters/{$group}/{$type}/master/" . $master->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the page.
     *
     * @param Model   $page
     *
     * @return Response
     */
    public function destroy(MasterRequest $request, $group, $type, Master $master)
    {
        try {

            $master->delete();
            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('page::page.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url("masters/{$group}/{$type}/master/" . $master->getRouteKey()))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url("masters/{$group}/{$type}/master/" . $page->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * to display values under specific option
     * @param  [type] $religion [description]
     * @return [type]           [description]
     */
    public function options($religion)
    {
        $options = $this->repository->options($religion);
        return view('master::default.master.suboptions', compact('options'));

    }

}
