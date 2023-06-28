<?php

namespace Litepie\Menu\Http\Controllers;

use Exception;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Menu\Actions\MenuAction;
use Litepie\Menu\Actions\MenuActions;
use Litepie\Menu\Forms\Menu as MenuForm;
use Litepie\Menu\Http\Requests\MenuResourceRequest;
use Litepie\Menu\Http\Resources\MenuResource;
use Litepie\Menu\Http\Resources\MenusCollection;
use Litepie\Menu\Models\Menu;

/**
 * Resource controller class for menu.
 */
class MenuResourceController extends BaseController
{

    /**
     * Initialize menu resource controller.
     *
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            $this->form = MenuForm::grouped(false)
                ->setAttributes()
                ->toArray();
            $this->modules = $this->modules(config('menu.modules'), 'menu', guard_url('menu'));
            return $next($request);
        });
    }

    /**
     * Display a list of menu.
     *
     * @return Response
     */
    public function index(MenuResourceRequest $request)
    {
        $request = $request->all();
        $page = MenuActions::run('paginate', $request);

        $data = new MenusCollection($page);
        $rootMenu = app(Menu::class)->rootMenues();
        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('menu::menu.names'))
            ->view('menu::admin.index')
            ->data(compact('rootMenu', 'data', 'modules', 'form'))
            ->output();

    }

    /**
     * Display menu.
     *
     * @param Request $request
     * @param Model   $menu
     *
     * @return Response
     */
    public function show(MenuResourceRequest $request, Menu $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $menu = new MenuResource($model);
        return $this->response
            ->setMetaTitle(trans('app.view') . ' ' . trans('menu::menu.name'))
            ->data(compact('menu', 'form', 'modules'))
            ->view('menu::admin.show')
            ->output();
    }

    /**
     * Show the form for creating a new menu.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MenuResourceRequest $request, Menu $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new MenuResource($model);
        return $this->response->setMetaTitle(trans('app.new') . ' ' . trans('menu::menu.name'))
            ->view('menu::admin.create')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Create new menu.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MenuResourceRequest $request, Menu $model)
    {
        try {
            $request = $request->all();
            $model = MenuAction::run('store', $model, $request);
            $data = new MenuResource($model);
            return $this->response->message(trans('messages.success.created', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('menu/menu/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('/menu/menu'))
                ->redirect();
        }

    }

    /**
     * Show menu for editing.
     *
     * @param Request $request
     * @param Model   $menu
     *
     * @return Response
     */
    public function edit(MenuResourceRequest $request, Menu $model)
    {
        $form = $this->form;
        $modules = $this->modules;
        $data = new MenuResource($model);
        // return view('menu::admin.edit', compact('data', 'form', 'modules'));

        return $this->response->setMetaTitle(trans('app.edit') . ' ' . trans('menu::menu.name'))
            ->view('menu::admin.edit')
            ->data(compact('data', 'form', 'modules'))
            ->output();

    }

    /**
     * Update the menu.
     *
     * @param Request $request
     * @param Model   $menu
     *
     * @return Response
     */
    public function update(MenuResourceRequest $request, Menu $model)
    {
        try {
            $request = $request->all();
            $model = MenuAction::run('update', $model, $request);
            $data = new MenuResource($model);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('menu/menu/' . $model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/menu/' . $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Remove the menu.
     *
     * @param Model   $menu
     *
     * @return Response
     */
    public function destroy(MenuResourceRequest $request, Menu $model)
    {
        try {
            $request = $request->all();
            MenuAction::run('destroy', $model, $request);
            $data = new MenuResource($model);

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('menu::menu.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('menu/menu/0'))
                ->redirect();

        } catch (Exception $e) {

            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/menu/' . $model->getRouteKey()))
                ->redirect();
        }

    }

    /**
     * Update tree structure  of the menu.
     *
     * @param MenuRequest $request
     * @param type        $id
     *
     * @return type
     */
    public function tree(MenuResourceRequest $request, Menu $model)
    {
        $request = $request->all();
        $model = MenuAction::run('updateTree', $model, $request);
    }
}
