<?php
namespace Litepie\Menu\Http\Controllers;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Litepie\Http\Controllers\ResourceController as ResourceController;
use Litepie\Menu\Forms\Menu as MenuForm;
use Litepie\Menu\Http\Requests\MenuResourceRequest;
use Litepie\Menu\Models\Menu;

class MenuSubResourceController extends ResourceController
{
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MenuResourceRequest $request, $id)
    {
        $menus = app(Menu::class)->find($id)->getChildren()->toArray();
        return self::$response->setMetaTitle(trans('menu::menu.names'))
            ->view('menu::admin.menu.nestable')
            ->data(compact('menus'))
            ->output();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(MenuResourceRequest $request, Menu $menu)
    {
        $menu = $menu->toArray();
        return self::$response->setMetaTitle(trans('menu::menu.names'))
            ->view('menu::admin.sub.show')
            ->data(compact('menu'))
            ->output();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MenuResourceRequest $request)
    {
        $menu            = app(Menu::class)->newInstance([]);
        $menu->parent_id = $request->get('parent_id', 0);

        return self::$response->setMetaTitle(trans('menu::menu.names'))
            ->view('menu::admin.sub.create')
            ->data(compact('menu'))
            ->output();

        // return view('menu::admin.sub.create', compact('menu'));
    }

    /**
     * Create the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MenuResourceRequest $request)
    {
        try {
            $attributes              = $request->all();
            $attributes['parent_id'] = hashids_decode($attributes['parent_id']);
            $menu                    = app(Menu::class)->create($attributes);
            $menu                    = $menu->getModel();

            return self::$response
                ->message(trans('messages.success.created', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('menu/submenu/' . $menu->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return self::$response
                ->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/menu/submenu'))
                ->redirect();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function edit(MenuResourceRequest $request, Menu $menu)
    {

        return self::$response->setMetaTitle(trans('menu::menu.names'))
            ->view('menu::admin.sub.edit')
            ->data(compact('menu'))
            ->output();

        // return view('menu::admin.sub.edit', compact('menu'));
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(MenuResourceRequest $request, Menu $menu)
    {
        try {
            $attributes = $request->all();

            $menu->update($attributes);
            return self::$response->message(trans('messages.success.updated', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('menu/submenu/' . $menu->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return self::$response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/submenu/' . $menu->getRouteKey()))
                ->redirect();
        }
    }
}
