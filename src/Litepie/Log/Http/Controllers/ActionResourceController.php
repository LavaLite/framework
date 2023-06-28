<?php

namespace Litepie\Log\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Log\Forms\Action as ActionForm;
use Litepie\Log\Http\Requests\ActionResourceRequest;
use Litepie\Log\Http\Resources\ActionResource;
use Litepie\Log\Http\Resources\ActionsCollection;
use Litepie\Log\Models\Action;
use Litepie\Log\Actions\ActionAction;
use Litepie\Log\Actions\ActionActions;


/**
 * Resource controller class for action.
 */
class ActionResourceController extends BaseController
{

    /**
     * Initialize action resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->form = ActionForm::grouped(false)
                        ->setAttributes()
                        ->toArray();
        $this->modules = $this->modules(config('log.modules'), 'log', guard_url('log'));
    }

    /**
     * Display a list of action.
     *
     * @return Response
     */
    public function index(ActionResourceRequest $request)
    {
        $request = $request->all();
        $page = ActionActions::run('paginate', $request);

        $data = new ActionsCollection($page);

        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('log::action.names'))
            ->view('log::action.index')
            ->data(compact('data', 'modules', 'form'))
            ->output();

    }

    /**
     * Display action.
     *
     * @param Request $request
     * @param Model   $action
     *
     * @return Response
     */
    public function show(ActionResourceRequest $request, Action $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ActionResource($model);
        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('log::action.name'))
            ->data(compact('data', 'form', 'modules'))
            ->view('log::action.show')
            ->output();
    }

    /**
     * Show the form for creating a new action.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(ActionResourceRequest $request, Action $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ActionResource($model);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('log::action.name'))
            ->view('log::action.create')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Create new action.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(ActionResourceRequest $request, Action $model)
    {
        try {
            $request = $request->all();
            $model = ActionAction::run('store', $model, $request);
            $data = new ActionResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('log::action.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('log/action/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/log/action'))
                ->redirect();
        }

    }

    /**
     * Show action for editing.
     *
     * @param Request $request
     * @param Model   $action
     *
     * @return Response
     */
    public function edit(ActionResourceRequest $request, Action $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ActionResource($model);
        // return view('log::action.edit', compact('data', 'form', 'modules'));

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('log::action.name'))
            ->view('log::action.edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Update the action.
     *
     * @param Request $request
     * @param Model   $action
     *
     * @return Response
     */
    public function update(ActionResourceRequest $request, Action $model)
    {
        try {
            $request = $request->all();
            $model = ActionAction::run('update', $model, $request);
            $data = new ActionResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('log::action.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('log/action/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('log/action/' .  $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the action.
     *
     * @param Model   $action
     *
     * @return Response
     */
    public function destroy(ActionResourceRequest $request, Action $model)
    {
        try {

            $request = $request->all();
            $model = ActionAction::run('destroy', $model, $request);
            $data = new ActionResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('log::action.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('log/action/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('log/action/' .  $model->getRouteKey()))
                ->redirect();
        }

    }
}
