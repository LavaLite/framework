<?php

namespace Litepie\Team\Http\Controllers;

use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Team\Interfaces\TeamRepositoryInterface;
use Litepie\Team\Http\Requests\TeamRequest;
use Litepie\Team\Models\Team;

/**
 * Resource controller class for Team.
 */
class TeamResourceController extends BaseController
{
    /**
     * Initialize team resource controller.
     *
     * @param type TeamRepositoryInterface $team
     *
     * @return null
     */
    public function __construct(TeamRepositoryInterface $team)
    {
        parent::__construct();
        $this->repository = $team;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\Team\Repositories\Criteria\TeamResourceCriteria::class);
    }

    /**
     * Display a list of team.
     *
     * @return Response
     */
    public function index(TeamRequest $request)
    {

        $pageLimit = $request->input('pageLimit', 10);
        $data = $this->repository
            ->setPresenter(\Litepie\Team\Repositories\Presenter\TeamPresenter::class)
            ->paginate($pageLimit);
        extract($data);
        $view = 'team::team.index';
        if ($request->ajax()) {
            $view = 'team::team.more';
        }
        return $this->response->setMetaTitle(trans('team::team.names'))
            ->view($view)
            ->data(compact('data', 'meta'))
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
    public function show(TeamRequest $request, Team $team)
    {

        if ($team->exists) {
            $view = 'team::team.show';
        } else {
            $view = 'team::team.new';
        }

        return $this->response->setMetaTitle(trans('app.view') . ' ' . trans('team::team.name'))
            ->data(compact('team'))
            ->view($view, true)
            ->output();
    }

    /**
     * Show the form for creating a new team.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(TeamRequest $request)
    {

        $team = $this->repository->newInstance([]);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('team::team.name'))
            ->view('team::team.create', true)
            ->data(compact('team'))
            ->output();
    }

    /**
     * Create new team.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(TeamRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['teams_id'] = teams_id();
            $attributes['teams_type'] = teams_type();
            $team = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('team::team.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('teams/team/' . $team->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/teams/team'))
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
    public function edit(TeamRequest $request, Team $team)
    {
        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('team::team.name'))
            ->view('team::team.edit', true)
            ->data(compact('team'))
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
    public function update(TeamRequest $request, Team $team)
    {
        try {
            $attributes = $request->all();
            $team->update($attributes);
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('team::team.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('teams/team/' . $team->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('teams/team/' . $team->getRouteKey()))
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
    public function destroy(TeamRequest $request, Team $team)
    {
        try {

            $team->delete();
            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('team::team.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('teams/team/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('teams/team/' . $team->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove multiple team.
     *
     * @param Model   $team
     *
     * @return Response
     */
    public function delete(TeamRequest $request, $type)
    {
        try {
            $ids = hashids_decode($request->input('ids'));

            if ($type == 'purge') {
                $this->repository->purge($ids);
            } else {
                $this->repository->delete($ids);
            }

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('team::team.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('teams/team'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('/teams/team'))
                ->redirect();
        }

    }

    /**
     * Restore deleted teams.
     *
     * @param Model   $team
     *
     * @return Response
     */
    public function restore(TeamRequest $request)
    {
        try {
            $ids = hashids_decode($request->input('ids'));
            $this->repository->restore($ids);

            return $this->response->message(trans('messages.success.restore', ['Module' => trans('team::team.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('/teams/team'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('/teams/team/'))
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
    public function attach(TeamRequest $request)
    {
        try {
            $attributes = $request->all();

            $team = $this->repository->attach($attributes);
            return $this->response->message(trans('messages.success.attached', ['Module' => trans('team::team.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('teams/team/' . $team->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('teams/team/' . $team->getRouteKey()))
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
    public function detach(TeamRequest $request)
    {
        try {
            $attributes = $request->all();
            $team = $this->repository->detach($attributes);
            return $this->response->message(trans('messages.success.detached', ['Module' => trans('team::team.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('teams/team/' . $team->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('teams/team/' . $team->getRouteKey()))
                ->redirect();
        }

    }
}
