<?php

namespace Litepie\Menu\Http\Controllers;

use Closure;
use Exception;
use Illuminate\Http\Request;
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
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return array_merge(
            parent::middleware(),
            [
                function (Request $request, Closure $next) {
                    self::$form = MenuForm::only('main')
                        ->setAttributes()
                        ->toArray();
                    self::$modules = self::modules(config('menu.modules'), 'menu', guard_url('menu'));

                    return $next($request);
                },
            ]
        );
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
        $form = self::$form;
        $modules = self::$modules;

        return self::$response->setMetaTitle(trans('menu::menu.names'))
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
        $form = self::$form;
        $modules = self::$modules;
        $menu = new MenuResource($model);

        return self::$response
            ->setMetaTitle(trans('app.view').' '.trans('menu::menu.name'))
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
        $form = self::$form;
        $modules = self::$modules;
        $data = new MenuResource($model);

        return self::$response->setMetaTitle(trans('app.new').' '.trans('menu::menu.name'))
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

            return self::$response->message(trans('messages.success.created', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->data(compact('data'))
                ->status('success')
                ->url(guard_url('menu/menu/'.$model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
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
        $form = self::$form;
        $modules = self::$modules;
        $data = new MenuResource($model);
        // return view('menu::admin.edit', compact('data', 'form', 'modules'));

        return self::$response->setMetaTitle(trans('app.edit').' '.trans('menu::menu.name'))
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

            return self::$response->message(trans('messages.success.updated', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('menu/menu/'.$model->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/menu/'.$model->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove the menu.
     *
     * @param Model $menu
     *
     * @return Response
     */
    public function destroy(MenuResourceRequest $request, Menu $model)
    {
        try {
            $request = $request->all();
            MenuAction::run('destroy', $model, $request);
            $data = new MenuResource($model);

            return self::$response->message(trans('messages.success.deleted', ['Module' => trans('menu::menu.name')]))
                ->code(202)
                ->status('success')
                ->data(compact('data'))
                ->url(guard_url('menu/menu/0'))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/menu/'.$model->getRouteKey()))
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
