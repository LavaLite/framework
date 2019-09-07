<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\APIController as BaseController;
use Litepie\User\Http\Requests\TeamRequest;
use Litepie\User\Interfaces\TeamRepositoryInterface;
use Litepie\User\Models\Team;

/**
 * APIController  class for team.
 */
class TeamAPIController extends BaseController
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
            ->pushCriteria(\Litepie\User\Repositories\Criteria\TeamResourceCriteria::class);
    }

    /**
     * Display a list of team.
     *
     * @return Response
     */
    public function index(TeamRequest $request)
    {
        return $this->repository
            ->setPresenter(\Litepie\User\Repositories\Presenter\TeamListPresenter::class)
            ->paginate();
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
        return $team->setPresenter(\Litepie\User\Repositories\Presenter\TeamListPresenter::class);

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
            $data = $request->all();
            $data['user_id'] = user_id();
            $data['user_type'] = user_type();
            $data = $this->repository->create($data);
            $message = trans('messages.success.created', ['Module' => trans('teams::user.name')]);
            $code = 204;
            $status = 'success';
            $url = guard_url('user/team/' . $team->getRouteKey());
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code = 400;
            $status = 'error';
            $url = guard_url('teams/team');
        }
        return compact('data', 'message', 'code', 'status', 'url');
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
            $data = $request->all();

            $team->update($data);
            $message = trans('messages.success.updated', ['Module' => trans('teams::user.name')]);
            $code = 204;
            $status = 'success';
            $url = guard_url('user/team/' . $team->getRouteKey());
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code = 400;
            $status = 'error';
            $url = guard_url('user/team/' . $team->getRouteKey());
        }
        return compact('data', 'message', 'code', 'status', 'url');
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
            $message = trans('messages.success.deleted', ['Module' => trans('teams::user.name')]);
            $code = 202;
            $status = 'success';
            $url = guard_url('user/team/0');
        } catch (Exception $e) {
            $message = $e->getMessage();
            $code = 400;
            $status = 'error';
            $url = guard_url('user/team/' . $team->getRouteKey());
        }
        return compact('message', 'code', 'status', 'url');
    }
}

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\APIController as BaseController;
use Form;
use Litepie\User\Http\Requests\TeamRequest;
use Litepie\User\Interfaces\TeamRepositoryInterface;
use Litepie\User\Models\Team;

/**
 * API controller class for team.
 */
class TeamAPIController extends BaseController
{

    /**
     * Initialize team API controller.
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
            ->pushCriteria(\Litepie\User\Repositories\Criteria\TeamAPICriteria::class);
    }

    /**
     * Display a list of team.
     *
     * @return Response
     */
    public function index(TeamRequest $request)
    {
        $view = $this->response->theme->listView();

        if ($this->response->typeIs('json')) {
            $function = camel_case('get-' . $view);
            return $this->repository
                ->setPresenter(\Litepie\User\Repositories\Presenter\TeamPresenter::class)
                ->$function();
        }

        $teams = $this->repository->paginate();

        return $this->response->setMetaTitle(trans('teams::user.names'))
            ->view('teams::user.index', true)
            ->data(compact('teams', 'view'))
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
            $view = 'teams::user.show';
        } else {
            $view = 'teams::user.new';
        }

        return $this->response->setMetaTitle(trans('app.view') . ' ' . trans('teams::user.name'))
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
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('teams::user.name'))
            ->view('teams::user.create', true)
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
            $attributes['user_id'] = user_id();
            $attributes['user_type'] = user_type();
            $team = $this->repository->create($attributes);

            return $this->response->message(trans('messages.success.created', ['Module' => trans('teams::user.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('user/team/' . $team->getRouteKey()))
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
        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('teams::user.name'))
            ->view('teams::user.edit', true)
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
            return $this->response->message(trans('messages.success.updated', ['Module' => trans('teams::user.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('user/team/' . $team->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/team/' . $team->getRouteKey()))
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
            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('teams::user.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('user/team/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/team/' . $team->getRouteKey()))
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

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('teams::user.name')]))
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

            return $this->response->message(trans('messages.success.restore', ['Module' => trans('teams::user.name')]))
                ->status("success")
                ->code(202)
                ->url(guard_url('/teams/team'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->status("error")
                ->code(400)
                ->url(guard_url('/user/team/'))
                ->redirect();
        }

    }

}
