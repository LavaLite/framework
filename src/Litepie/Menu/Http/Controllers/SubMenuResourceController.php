<?php

namespace Litepie\Menu\Http\Controllers;

use Form;
use Litepie\Http\Controllers\ResourceController as ResourceController;
use Litepie\Menu\Http\Requests\MenuRequest;
use Litepie\Menu\Interfaces\MenuRepositoryInterface;

class SubMenuResourceController extends ResourceController
{
    public function __construct(MenuRepositoryInterface $menu)
    {
        $this->repository = $menu;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MenuRequest $request, $id)
    {
        $menus = $this->repository->find($id)->getChildren();

        return $this->response->setMetaTitle(trans('menu::menu.names'))
                ->view('litepie.menu.admin.menu.nestable')
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
    public function show(MenuRequest $request, MenuRepositoryInterface $menu)
    {
        $menu = $menu->getModel();
        Form::populate($menu);

        return view('litepie.menu.admin.sub.show', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MenuRequest $request)
    {
        $menu = $this->repository->newInstance([]);
        $menu->parent_id = $request->get('parent_id', 0);

        Form::populate($menu);

        return view('litepie.menu.admin.sub.create', compact('menu'));
    }

    /**
     * Create the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(MenuRequest $request)
    {
        try {
            $attributes = $request->all();
            $attributes['parent_id'] = hashids_decode($attributes['parent_id']);
            $menu = $this->repository->create($attributes);
            $menu = $menu->getModel();

            return $this->response
                ->message(trans('messages.success.created', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('menu/submenu/'.$menu->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response
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
    public function edit(MenuRequest $request, MenuRepositoryInterface $menu)
    {
        $menu = $menu->getModel();

        Form::populate($menu);

        return view('litepie.menu.admin.sub.edit', compact('menu'));
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(MenuRequest $request, MenuRepositoryInterface $menu)
    {
        try {
            $attributes = $request->all();

            $menu->update($attributes);

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('menu/submenu/'.$menu->parent->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/submenu/'.$menu->parent->getRouteKey()))
                ->redirect();
        }
    }
}
