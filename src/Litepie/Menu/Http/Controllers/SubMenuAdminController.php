<?php

namespace Litepie\Menu\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use Form;
use Litepie\Menu\Http\Requests\MenuRequest;
use Litepie\Menu\Models\Menu as Menu;

class SubMenuAdminController extends AdminController
{
    private $view;

    public function __construct(\Litepie\Contracts\Menu\MenuRepository $menu)
    {
        $this->repository = $menu;
        parent::__construct();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(MenuRequest $request, $id)
    {
        $menu = $this->repository->find($id);
        Form::populate($menu);

        return view('Menu::sub.show', compact('parent', 'menu'));
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

        return view('Menu::sub.create', compact('menu'));
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
            $attributes['user_id'] = user_id();
            $attributes['parent_id'] = hashids_decode($attributes['parent_id']);
            $menu = $this->repository->create($attributes);

            $this->responseCode = 201;
            $this->responseMessage = trans('messages.success.created', ['Module' => trans('menu::menu.name')]);
            $this->responseRedirect = trans_url('/admin/menu/submenu/'.$menu->getRouteKey());

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();

            return $this->respond($request);
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
    public function edit(MenuRequest $request, $id)
    {
        $menu = $this->repository->find($id);

        Form::populate($menu);

        return view('Menu::sub.edit', compact('menu'));
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(MenuRequest $request, $id)
    {
        try {
            $menu = $this->repository->update($request->all(), $id);

            $this->responseCode = 204;
            $this->responseMessage = trans('messages.success.updated', ['Module' => trans('menu::menu.name')]);
            $this->responseRedirect = trans_url('/admin/menu/submenu/'.$menu->getRouteKey());

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/menu/submenu/'.$menu->getRouteKey());

            return $this->respond($request);
        }
    }
}
