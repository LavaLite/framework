<?php

namespace Litepie\User\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\User\Actions\ClientAction;
use Litepie\User\Actions\ClientActions;
use Litepie\User\Forms\Client as ClientForm;
use Litepie\User\Http\Requests\ClientResourceRequest;
use Litepie\User\Http\Resources\ClientResource;
use Litepie\User\Http\Resources\ClientsCollection;
use Litepie\User\Models\Client;

/**
 * Resource controller class for client.
 */
class ClientResourceController extends BaseController
{

    /**
     * Initialize client resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $this->form = ClientForm::only('main')
                ->setAttributes()
                ->toArray();
            $this->modules = $this->modules(config('user.modules'), 'user', guard_url('user'));
            return $next($request);
        });
    }

    /**
     * Display a list of client.
     *
     * @return Response
     */
    public function index(ClientResourceRequest $request)
    {
        $request = $request->all();
        $page = ClientActions::run('paginate', $request);

        $data = new ClientsCollection($page);

        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('user::client.names'))
            ->view('user::client.index')
            ->data(compact('data', 'modules', 'form'))
            ->output();

    }

    /**
     * Display client.
     *
     * @param Request $request
     * @param Model   $client
     *
     * @return Response
     */
    public function show(ClientResourceRequest $request, Client $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ClientResource($model);
        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('user::client.name'))
            ->data(compact('data', 'form', 'modules'))
            ->view('user::client.show')
            ->output();
    }

    /**
     * Show the form for creating a new client.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(ClientResourceRequest $request, Client $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ClientResource($model);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('user::client.name'))
            ->view('user::client.create')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Create new client.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(ClientResourceRequest $request, Client $model)
    {
        try {
            $request = $request->all();
            $model = ClientAction::run('store', $model, $request);
            $data = new ClientResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('user::client.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('user/client/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/user/client'))
                ->redirect();
        }

    }

    /**
     * Show client for editing.
     *
     * @param Request $request
     * @param Model   $client
     *
     * @return Response
     */
    public function edit(ClientResourceRequest $request, Client $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new ClientResource($model);
        // return view('user::client.edit', compact('data', 'form', 'modules'));

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('user::client.name'))
            ->view('user::client.edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Update the client.
     *
     * @param Request $request
     * @param Model   $client
     *
     * @return Response
     */
    public function update(ClientResourceRequest $request, Client $model)
    {
        try {
            $request = $request->all();
            $model = ClientAction::run('update', $model, $request);
            $data = new ClientResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('user::client.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('user/client/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/client/' . $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the client.
     *
     * @param Model   $client
     *
     * @return Response
     */
    public function destroy(ClientResourceRequest $request, Client $model)
    {
        try {

            $request = $request->all();
            $model = ClientAction::run('destroy', $model, $request);
            $data = new ClientResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('user::client.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('user/client/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('user/client/' . $model->getRouteKey()))
                ->redirect();
        }

    }
}
