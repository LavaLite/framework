<?php

namespace Litepie\Master\Http\Controllers;

use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Master\Forms\Master as Form;
use Litepie\Master\Http\Requests\MasterRequest;
use Litepie\Master\Interfaces\MasterRepositoryInterface;
use Litepie\Master\Models\Master;

/**
 * APIController  class for master.
 */
class MasterAPIController extends BaseController
{
    /**
     * Initialize master resource controller.
     *
     * @param type MasterRepositoryInterface $master
     *
     * @return null
     */
    public function __construct(MasterRepositoryInterface $master)
    {
        parent::__construct();
        $this->repository = $master;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\Master\Repositories\Criteria\MasterResourceCriteria::class);
    }

    /**
     * Display a list of master.
     *
     * @return Response
     */
    public function index(MasterRequest $request)
    {
        return $this->repository
            ->setPresenter(\Litepie\Master\Repositories\Presenter\MasterPresenter::class)
            ->paginate();
    }

    /**
     * Display master.
     *
     * @param Request $request
     * @param Model   $master
     *
     * @return Response
     */
    public function show(MasterRequest $request, Master $master)
    {
        return $master->setPresenter(\Litepie\Master\Repositories\Presenter\MasterListPresenter::class);
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
            $data = $request->all();
            $data['user_id'] = user_id();
            $data['user_type'] = user_type();
            $data = $this->repository->create($data);
            $message = trans('messages.success.created', ['Module' => trans('master::master.name')]);
            $code = 204;
            $status = 'success';
            $url = guard_url('master/master/'.$master->getRouteKey());
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code = 400;
            $status = 'error';
            $url = guard_url('master/master');
        }

        return compact('data', 'message', 'code', 'status', 'url');
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
            $data = $request->all();

            $master->update($data);
            $message = trans('messages.success.updated', ['Module' => trans('master::master.name')]);
            $code = 204;
            $status = 'success';
            $url = guard_url('master/master/'.$master->getRouteKey());
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code = 400;
            $status = 'error';
            $url = guard_url('master/master/'.$master->getRouteKey());
        }

        return compact('data', 'message', 'code', 'status', 'url');
    }

    /**
     * Remove the master.
     *
     * @param Model $master
     *
     * @return Response
     */
    public function destroy(MasterRequest $request, Master $master)
    {
        try {
            $master->delete();
            $message = trans('messages.success.deleted', ['Module' => trans('master::master.name')]);
            $code = 202;
            $status = 'success';
            $url = guard_url('master/master/0');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code = 400;
            $status = 'error';
            $url = guard_url('master/master/'.$master->getRouteKey());
        }

        return compact('message', 'code', 'status', 'url');
    }

    /**
     * Return the form elements as json.
     *
     * @param string $element
     *
     * @return json
     */
    public function form($element = 'fields')
    {
        $form = new Form();

        return $form->form($element, true);
    }

    public function search(MasterRequest $request, $type, $key, $value)
    {
        return $this->repository->search($request->q, $type, $key, $value);
    }
}
