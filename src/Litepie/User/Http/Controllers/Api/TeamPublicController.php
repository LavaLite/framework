<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\Api\PublicController as BaseController;
use Litepie\User\Interfaces\TeamRepositoryInterface;
use Litepie\User\Repositories\Presenter\TeamItemTransformer;

/**
 * Pubic API controller class.
 */
class TeamPublicApiController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Team\Interfaces\TeamRepositoryInterface $team
     *
     * @return type
     */
    public function __construct(TeamRepositoryInterface $team)
    {
        $this->repository = $team;
        parent::__construct();
    }

    /**
     * Show team's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $teams = $this->repository
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\TeamListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $teams['code'] = 2000;
        return response()->json($teams)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show team.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $team = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($team)) {
            $team         = $this->itemPresenter($module, new TeamItemTransformer);
            $team['code'] = 2001;
            return response()->json($team)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
