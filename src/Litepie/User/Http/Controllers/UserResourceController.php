<?php

namespace Litepie\User\Http\Controllers;

use Exception;
use Litecms\Location\Actions\CountryActions;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\User\Actions\UserAction;
use Litepie\User\Actions\UserActions;
use Litepie\User\Forms\User as UserForm;
use Litepie\User\Http\Requests\UserResourceRequest;
use Litepie\User\Http\Resources\UserResource;
use Litepie\User\Http\Resources\UsersCollection;
use Litepie\User\Models\User;

/**
 * Resource controller class for user.
 */
class UserResourceController extends BaseController
{

    /**
     * Initialize user resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->form = UserForm::setAttributes()
                ->toArray();
            $this->modules = $this->modules(config('user.modules'), 'user', guard_url('user'));
            return $next($request);
        });
    }

    /**
     * Display a list of user.
     *
     * @return Response
     */
    public function index(UserResourceRequest $request)
    {
        $request = $request->all();
        $page = UserActions::run('paginate', $request);

        $data = new UsersCollection($page);

        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('user::user.names'))
            ->view('user::user.index')
            ->data(compact('data', 'modules', 'form'))
            ->output();
    }

    /**
     * Display user.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function show(UserResourceRequest $request, User $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new UserResource($model);
        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('user::user.name'))
            ->data(compact('data', 'form', 'modules'))
            ->view('user::user.show')
            ->output();
    }

    /**
     * Show the form for creating a new user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(UserResourceRequest $request, User $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new UserResource($model);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('user::user.name'))
            ->view('user::user.create')
            ->data(compact('data', 'form', 'modules'))
            ->output();
    }

    /**
     * Create new user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(UserResourceRequest $request, User $model)
    {
        try {
            $request = $request->all();
            $model = UserAction::run('store', $model, $request);
            $data = new UserResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('user::user.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('user/user/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/user/user'))
                ->redirect();
        }
    }

    /**
     * Show user for editing.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function edit(UserResourceRequest $request, User $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new UserResource($model);
        // return view('user::user.edit', compact('data', 'form', 'modules'));

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('user::user.name'))
            ->view('user::user.edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();
    }

    /**
     * Update the user.
     *
     * @param Request $request
     * @param Model   $user
     *
     * @return Response
     */
    public function update(UserResourceRequest $request, User $model)
    {
        try {
            $request = $request->all();
            $model = UserAction::run('update', $model, $request);
            $data = new UserResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('user::user.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('user/user/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/user/' . $model->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove the user.
     *
     * @param Model   $user
     *
     * @return Response
     */
    public function destroy(UserResourceRequest $request, User $model)
    {
        try {

            $request = $request->all();
            $model = UserAction::run('destroy', $model, $request);
            $data = new UserResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('user::user.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('user/user/0'))
                ->redirect();
        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/user/' . $model->getRouteKey()))
                ->redirect();
        }
    }

    public function masterDatas(UserResourceRequest $request)
    {
        $form = $this->form;
        $data['data'] = [
            'id_hashed' => hashids_encode(user()->id),
        ];
        $data['options'] = [
            'country' => CountryActions::run($request, 'options'),
            'sex'   => trans('setting.options.gender'),
            'languages' => trans('setting.options.languages'),
        ];
        $data['fields'] = $form['fields'];
        return $data;
    }
}
