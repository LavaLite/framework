<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\Api\PublicController as BaseController;
use Litepie\User\Interfaces\PermissionRepositoryInterface;
use Litepie\User\Repositories\Presenter\PermissionItemTransformer;

/**
 * Pubic API controller class.
 */
class PermissionPublicApiController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Permission\Interfaces\PermissionRepositoryInterface $permission
     *
     * @return type
     */
    public function __construct(PermissionRepositoryInterface $permission)
    {
        $this->repository = $permission;
        parent::__construct();
    }

    /**
     * Show permission's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $permissions = $this->repository
            ->setPresenter('\\Litepie\\User\\Repositories\\Presenter\\PermissionListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $permissions['code'] = 2000;
        return response()->json($permissions)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show permission.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $permission = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($permission)) {
            $permission         = $this->itemPresenter($module, new PermissionItemTransformer);
            $permission['code'] = 2001;
            return response()->json($permission)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
