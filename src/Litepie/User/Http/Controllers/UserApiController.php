<?php

namespace Litepie\User\Http\Controllers;

use App\Http\Controllers\APIController as BaseController;
use App\User;
use Illuminate\Support\Str;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\User\Http\Requests\UserRequest;
use Litepie\User\Interfaces\UserRepositoryInterface;

/**
 * Resource controller class for user.
 */
class UserApiController extends BaseController
{

    /**
     * Initialize user resource controller.
     *
     * @param type UserRepositoryInterface $user
     *
     * @return null
     */
    public function __construct(
        UserRepositoryInterface $user
    ) {
        parent::__construct();
        $this->repository = $user;
        $this->repository
            ->pushCriteria(\Litepie\Repository\Criteria\RequestCriteria::class)
            ->pushCriteria(\Litepie\User\Repositories\Criteria\UserResourceCriteria::class);
    }

    /**
     * Return json array for select element.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function select(UserRequest $request)
    {
        try {
            $q = $request->get('q');
            $name = $request->get('name');
            $key = $request->get('key');
            $count = $request->get('count');
            $data = $this->repository->select($q, $count, $key, null);

            $message = trans('messages.success.listed', ['Module' => trans('user::user.name')]);
            $code = 204;
            $status = 'success';
        } catch (Exception $e) {
            $data = [];
            $message = $e->getMessage();
            $code = 400;
            $status = 'error';
        }
        return compact('data', 'message', 'code', 'status');
    }
}
