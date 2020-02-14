<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\APIController as BaseController;
use Litepie\User\Http\Requests\TeamRequest;
use Litepie\User\Interfaces\TeamRepositoryInterface;
use Litepie\User\Models\Team;
use Illuminate\Support\Str;
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
