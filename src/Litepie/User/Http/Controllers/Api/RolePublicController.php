<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\Api\PublicController as BaseController;
use Litepie\User\Interfaces\RoleRepositoryInterface;
use Litepie\User\Repositories\Presenter\RoleItemTransformer;

/**
 * Pubic API controller class.
 */
class RolePublicApiController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Role\Interfaces\RoleRepositoryInterface $role
     *
     * @return type
     */
    public function __construct(RoleRepositoryInterface $role)
    {
        $this->repository = $role;
        parent::__construct();
    }

    /**
     * Show role's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $roles = $this->repository
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\RoleListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $roles['code'] = 2000;
        return response()->json($roles)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show role.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $role = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($role)) {
            $role         = $this->itemPresenter($module, new RoleItemTransformer);
            $role['code'] = 2001;
            return response()->json($role)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
