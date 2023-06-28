<?php

namespace Litepie\Log\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Log\Forms\Activity as ActivityForm;
use Litepie\Log\Http\Requests\ActivityResourceRequest;
use Litepie\Log\Http\Resources\ActivityResource;
use Litepie\Log\Http\Resources\ActivitiesCollection;
use Litepie\Log\Models\Activity;
use Litepie\Log\Actions\ActivityAction;
use Litepie\Log\Actions\ActivityActions;


/**
 * Resource controller class for activity.
 */
class ActivityResourceController extends BaseController
{

    /**
     * Initialize activity resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->form = ActivityForm::grouped(false)
                        ->setAttributes()
                        ->toArray();
        $this->modules = $this->modules(config('log.modules'), 'log', guard_url('log'));
    }

    /**
     * Display a list of activity.
     *
     * @return Response
     */
    public function index(ActivityResourceRequest $request)
    {
        $request = $request->all();
        $page = ActivityActions::run('paginate', $request);

        $data = new ActivitiesCollection($page);

        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('log::activity.names'))
            ->view('log::activity.index')
            ->data(compact('data', 'modules', 'form'))
            ->output();

    }

    /**
     * Display activity.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return Response
     */
    public function show(ActivityResourceRequest $request, Activity $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ActivityResource($model);
        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('log::activity.name'))
            ->data(compact('data', 'form', 'modules'))
            ->view('log::activity.show')
            ->output();
    }

    /**
     * Show the form for creating a new activity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(ActivityResourceRequest $request, Activity $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ActivityResource($model);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('log::activity.name'))
            ->view('log::activity.create')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Create new activity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(ActivityResourceRequest $request, Activity $model)
    {
        try {
            $request = $request->all();
            $model = ActivityAction::run('store', $model, $request);
            $data = new ActivityResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('log::activity.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('log/activity/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/log/activity'))
                ->redirect();
        }

    }

    /**
     * Show activity for editing.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return Response
     */
    public function edit(ActivityResourceRequest $request, Activity $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ActivityResource($model);
        // return view('log::activity.edit', compact('data', 'form', 'modules'));

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('log::activity.name'))
            ->view('log::activity.edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Update the activity.
     *
     * @param Request $request
     * @param Model   $activity
     *
     * @return Response
     */
    public function update(ActivityResourceRequest $request, Activity $model)
    {
        try {
            $request = $request->all();
            $model = ActivityAction::run('update', $model, $request);
            $data = new ActivityResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('log::activity.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('log/activity/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('log/activity/' .  $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the activity.
     *
     * @param Model   $activity
     *
     * @return Response
     */
    public function destroy(ActivityResourceRequest $request, Activity $model)
    {
        try {

            $request = $request->all();
            $model = ActivityAction::run('destroy', $model, $request);
            $data = new ActivityResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('log::activity.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('log/activity/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('log/activity/' .  $model->getRouteKey()))
                ->redirect();
        }

    }
}
