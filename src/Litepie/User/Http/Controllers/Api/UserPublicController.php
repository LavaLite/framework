<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\Api\PublicController as BaseController;
use Litepie\User\Interfaces\UserRepositoryInterface;
use Litepie\User\Repositories\Presenter\UserItemTransformer;

/**
 * Pubic API controller class.
 */
class UserPublicApiController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\User\Interfaces\UserRepositoryInterface $user
     *
     * @return type
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->repository = $user;
        parent::__construct();
    }

    /**
     * Show user's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $users = $this->repository
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\UserListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $users['code'] = 2000;
        return response()->json($users)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show user.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $user = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($user)) {
            $user         = $this->itemPresenter($module, new UserItemTransformer);
            $user['code'] = 2001;
            return response()->json($user)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
