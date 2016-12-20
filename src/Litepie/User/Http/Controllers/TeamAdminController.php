<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\AdminController as BaseController;
use Form;
use Litepie\User\Http\Requests\TeamRequest;
use Litepie\User\Interfaces\TeamRepositoryInterface;
use Litepie\User\Models\Team;

/**
 * Admin web controller class.
 */
class TeamAdminController extends BaseController
{
    // use TeamWorkflow;
    /**
     * Initialize team controller.
     *
     * @param type TeamRepositoryInterface $team
     *
     * @return type
     */
    public function __construct(TeamRepositoryInterface $team)
    {
        $this->repository = $team;
        parent::__construct();
    }

    /**
     * Display a list of team.
     *
     * @return Response
     */
    public function index(TeamRequest $request)
    {
        if ($request->wantsJson()) {
            return $this->getJson($request);
        }
        $this   ->theme->prependTitle(trans('user::team.names').' :: ');
        return $this->theme->of('vuser::admin.team.index')->render();
    }

    /**
     * Display a list of team.
     *
     * @return Response
     */
    public function getJson(TeamRequest $request)
    {
        $pageLimit = $request->input('pageLimit');

        $teams  = $this->repository
                ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
                ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\TeamListPresenter')
                ->scopeQuery(function($query){
                    return $query->orderBy('id','DESC');
                })->paginate($pageLimit);
        $teams['recordsTotal']    = $teams['meta']['pagination']['total'];
        $teams['recordsFiltered'] = $teams['meta']['pagination']['total'];
        $teams['request']         = $request->all();
        return response()->json($teams, 200);

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
        if (!$team->exists) {
            return response()->view('vuser::admin.team.new', compact('team'));
        }

        Form::populate($team);
        return response()->view('vuser::admin.team.show', compact('team'));
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

        Form::populate($team);

        return response()->view('vuser::admin.team.create', compact('team'));

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
            $attributes             = $request->all();
            $attributes['user_id']  = user_id('admin.web');
            $team          = $this->repository->create($attributes);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::team.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/team/'.$team->getRouteKey())
            ], 201);


        } catch (Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
            ], 400);
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
        Form::populate($team);
        return  response()->view('vuser::admin.team.edit', compact('team'));
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

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('user::team.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/user/team/'.$team->getRouteKey())
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/team/'.$team->getRouteKey()),
            ], 400);

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

            $t = $team->delete();

            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('user::team.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/user/team/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/user/team/'.$team->getRouteKey()),
            ], 400);
        }
    }

}
