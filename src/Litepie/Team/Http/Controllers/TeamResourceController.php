<?php

namespace Litepie\Team\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Team\Actions\TeamAction;
use Litepie\Team\Actions\TeamActions;
use Litepie\Team\Forms\Team as TeamForm;
use Litepie\Team\Http\Requests\TeamResourceRequest;
use Litepie\Team\Http\Resources\TeamResource;
use Litepie\Team\Http\Resources\TeamsCollection;
use Litepie\Team\Models\Team;

/**
 * Resource controller class for team.
 */
class TeamResourceController extends BaseController
{

    /**
     * Initialize team resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->form = TeamForm::grouped(false)
                ->setAttributes()
                ->toArray();
            $this->modules = $this->modules(config('team.modules'), 'team', guard_url('team'));
            return $next($request);
        });
    }

    /**
     * Display a list of team.
     *
     * @return Response
     */
    public function index(TeamResourceRequest $request)
    {
        $request = $request->all();
        $page = TeamActions::run('paginate', $request);

        $data = new TeamsCollection($page);

        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('team::team.names'))
            ->view('team::index')
            ->data(compact('data', 'modules', 'form'))
            ->output();

    }

    /**
     * Display team.
     *
     * @param Request $request
     * @param Model   $team
     *
     * @return Response
     */
    public function show(TeamResourceRequest $request, Team $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new TeamResource($model);
        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('team::team.name'))
            ->data(compact('data', 'form', 'modules'))
            ->view('team::show')
            ->output();
    }

    /**
     * Show the form for creating a new team.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(TeamResourceRequest $request, Team $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new TeamResource($model);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('team::team.name'))
            ->view('team::create')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Create new team.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(TeamResourceRequest $request, Team $model)
    {
        try {
            $request = $request->all();
            $model = TeamAction::run('store', $model, $request);
            $data = new TeamResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('team::team.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('team/team/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/team/team'))
                ->redirect();
        }

    }

    /**
     * Show team for editing.
     *
     * @param Request $request
     * @param Model   $team
     *
     * @return Response
     */
    public function edit(TeamResourceRequest $request, Team $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new TeamResource($model);
        // return view('team::edit', compact('data', 'form', 'modules'));

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('team::team.name'))
            ->view('team::edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Update the team.
     *
     * @param Request $request
     * @param Model   $team
     *
     * @return Response
     */
    public function update(TeamResourceRequest $request, Team $model)
    {
        try {
            $request = $request->all();
            $model = TeamAction::run('update', $model, $request);
            $data = new TeamResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('team::team.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('team/team/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('team/team/' . $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the team.
     *
     * @param Model   $team
     *
     * @return Response
     */
    public function destroy(TeamResourceRequest $request, Team $model)
    {
        try {

            $request = $request->all();
            $model = TeamAction::run('destroy', $model, $request);
            $data = new TeamResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('team::team.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('team/team/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('team/team/' . $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Attach a teams to a team.
     *
     * @param Request $request
     * @param Model   $team
     *
     * @return Response
     */
    public function attach(TeamResourceRequest $request, Team $model)
    {
        try {
            $request = $request->all();

            $model = TeamAction::run('attach', $model, $request);
            $data = new TeamResource($model);

            return $this->response->message(trans('messages.success.attached', ['Module' => trans('team::team.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('teams/team/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('teams/team/' . $model->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Detach a teams from a team.
     *
     * @param Request $request
     * @param Model   $team
     *
     * @return Response
     */
    public function detach(TeamResourceRequest $request, Team $model)
    {
        try {
            $request = $request->all();
            $model = TeamAction::run('detach', $model, $request);
            $data = new TeamResource($model);

            return $this->response->message(trans('messages.success.detached', ['Module' => trans('team::team.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('teams/team/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('teams/team/' . $model->getRouteKey()))
                ->redirect();
        }
    }
}
