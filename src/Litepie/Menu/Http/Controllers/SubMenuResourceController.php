<?php

namespace Litepie\Menu\Http\Controllers;

use App\Http\Controllers\ResourceController as ResourceController;
use Form;
use Litepie\Menu\Http\Requests\MenuRequest;
use Litepie\Menu\Interfaces\MenuRepositoryInterface;
use Litepie\Menu\Models\Menu as Menu;

class SubMenuResourceController extends ResourceController
{

    public function __construct(MenuRepositoryInterface $menu)
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

        return view('menu::admin.sub.show', compact('parent', 'menu'));
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
        $menu            = $this->repository->newInstance([]);
        $menu->parent_id = $request->get('parent_id', 0);

        Form::populate($menu);

        return view('menu::admin.sub.create', compact('menu'));
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
            $attributes              = $request->all();
            $attributes['user_id']   = user_id('admin.web');
            $attributes['parent_id'] = hashids_decode($attributes['parent_id']);
            $menu                    = $this->repository->create($attributes);

            return response()->json(
                [
                    'message'  => trans('messages.success.updated', ['Module' => trans('menu::menu.name')]),
                    'code'     => 204,
                    'redirect' => trans_url('/admin/menu/submenu/' . $menu->getRouteKey()),
                ],
                201);

        } catch (Exception $e) {
            return response()->json(
                [
                    'message' => $e->getMessage(),
                    'code'    => 400,
                ],
                400);
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

        return view('menu::admin.sub.edit', compact('menu'));
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

            $attributes = $request->all();

            $menu = $this->repository->update($attributes, $id);

            return response()->json([
                'message'  => trans('messages.success.updated', ['Module' => trans('menu::menu.name')]),
                'code'     => 204,
                'redirect' => trans_url('/admin/menu/submenu/' . $menu->getRouteKey()),
            ], 201);

        } catch (Exception $e) {

            return response()->json(
                [
                    'message'  => $e->getMessage(),
                    'code'     => 400,
                    'redirect' => trans_url('/admin/menu/submenu/' . $menu->getRouteKey()),
                ],
                400);

        }

    }
}
