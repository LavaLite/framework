<?php

namespace Litepie\Master\Http\Controllers;

use App\Http\Controllers\ResourceController as BaseController;
use Form;
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

        $view = $this->response->theme->listView();

        if ($this->response->typeIs('json')) {
            $function = camel_case('get-' . $view);
            return $this->repository
                ->setPresenter(\Litepie\Master\Repositories\Presenter\MasterPresenter::class)
                ->$function();
        }

        if ($type == null) {
            $view = 'master::master.home';
        } else {
            $view = 'master::master.index';
        }

        $masters = $this->repository->paginate();

        return $this->response->setMetaTitle(trans('master::master.names'))
            ->view($view)
            ->data(compact('masters', 'group', 'type'))
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
    public function show(MasterRequest $request, $group, $type, $master)
    {

        if ($master->exists) {
            $view = 'master::master.show';
        } else {
            $view = 'master::master.new';
        }

        return $this->response->setMetaTitle(trans('app.view') . ' ' . trans('master::master.name'))
            ->data(compact('master', 'type'))
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
    public function create(MasterRequest $request)
    {

        $master = $this->repository->newInstance([]);

        return $this->response->title(trans('app.new') . ' ' . trans('master::master.name'))
            ->view('master::master.create', true)
            ->data(compact('master', 'type'))
            ->output();
    }

    /**
     * Create new master.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MasterRequest $request)
    {
        try {
            $attributes              = $request->all();
            $attributes['user_id']   = user_id();
            $attributes['user_type'] = user_type();
            $attributes['type']      = $this->type;

            if (empty($attributes['parent_id'])) {
                $attributes['parent_id'] = 0;
            }

            if ($attributes['type'] == 'education_type' || $attributes['type'] == 'occupation_type') {
                $attributes['type'] = strstr(request()->type, '_', true);

            }

            $master = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('master::master.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('master/master/' . $master->getRouteKey()))
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
    public function edit(MasterRequest $request, Master $master)
    {
        $type = $this->type;
        return $this->response->title(trans('app.edit') . ' ' . trans('master::master.name'))
            ->view('master::master.edit', true)
            ->data(compact('master', 'type'))
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
    public function update(MasterRequest $request, Master $master)
    {
        try {
            $attributes = $request->all();

            $master->update($attributes);
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('master::master.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('master/master/' . $master->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('master/master/' . $master->getRouteKey()))
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
