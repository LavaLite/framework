<?php

namespace Litepie\Menu\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use Form;
use Litepie\Menu\Http\Requests\AdminMenuRequest;
use Litepie\Menu\Models\Menu;
use Response;

class MenuAdminController extends AdminController
{

    private $view;

    /**
     * Initialize page controller.
     *
     * @param type PageRepositoryInterface $page
     *
     * @return type
     */
    public function __construct(\Litepie\Contracts\Menu\MenuRepository $menu)
    {
        $this->repository = $menu;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(AdminMenuRequest $request, $parent = 1)
    {
        $parent   = $this->repository->find(hashids_encode($parent));
        $rootMenu = $this->repository->rootMenues();

        $this->theme->prependTitle(trans('menu::menu.names') . ' :: ');

        $this->theme->asset()->container('footer')->usepath()->add('nestable', 'packages/nestable/jquery.nestable.js');

        return $this->theme->of('menu::admin.index', compact('rootMenu', 'parent'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(AdminMenuRequest $request, $parent)
    {

        if ($request->ajax()) {
            $menu = $parent;

            Form::populate($menu);

            return view('menu::admin.show', compact('menu'));
        }

        //$menu   = $this->repository->find($id);
        $rootMenu = $this->repository->rootMenues();
        $this->theme->asset()->container('footer')->usepath()->add('nestable', 'packages/nestable/jquery.nestable.js');

        $this->theme->prependTitle(trans('menu::menu.names') . ' :: ');

        return $this->theme->of('menu::admin.index', compact('rootMenu', 'parent'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(AdminMenuRequest $request, Menu $menu)
    {
        $menu = $this->repository->newInstance([]);

        Form::populate($menu);

        return view('menu::admin.create', compact('menu'));
    }

    /**
     * Create the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(AdminMenuRequest $request)
    {
        try {
            $attributes            = $request->all();
            $attributes['user_id'] = user_id('admin.web');
            $menu                  = $this->repository->create($attributes);

            return response()->json(
                [
                    'message'  => trans('messages.success.updated', ['Module' => trans('menu::menu.name')]),
                    'code'     => 204,
                    'redirect' => trans_url('/admin/menu/menu/' . $menu->getRouteKey()),
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
    public function edit(AdminMenuRequest $request, $menu)
    {
        $data['menu'] = $menu;
        Form::populate($data['menu']);

        return view('menu::admin.edit', $data);
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(AdminMenuRequest $request, $menu)
    {
        try {

            $attributes = $request->all();

            $menu->update($attributes);

            return response()->json(
                [
                    'message'  => trans('messages.success.updated', ['Module' => trans('menu::menu.name')]),
                    'code'     => 204,
                    'redirect' => trans_url('/admin/menu/menu/' . $menu->getRouteKey()),
                ],
                201);

        } catch (Exception $e) {

            return response()->json(
                [
                    'message'  => $e->getMessage(),
                    'code'     => 400,
                    'redirect' => trans_url('/admin/menu/menu/' . $menu->getRouteKey()),
                ],
                400);

        }

    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(AdminMenuRequest $request, Menu $menu)
    {
        $cid = $menu->id;
        if ($this->repository->findByField('parent_id', $cid)->count() > 0) {
            return response()->json([
                'message' => 'Child menu exists.',
                'type'    => 'warning',
                'title'   => 'Warning',
            ], 409);
        }

        try {

            $menu->delete();
            return response()->json([
                'message'  => trans('messages.success.deleted', ['Module' => trans('menu::menu.name')]),
                'code'     => 202,
                'redirect' => trans_url('/admin/menu/menu/0'),
            ], 202);

        } catch (Exception $e) {

            return response()->json([
                'message'  => $e->getMessage(),
                'code'     => 400,
                'redirect' => trans_url('/admin/menu/menu/' . $menu->getRouteKey()),
            ], 400);
        }

    }

    /**
     * Update tree structure  of the menu.
     *
     * @param AdminMenuRequest $request
     * @param type $id
     *
     * @return type
     */
    public function tree(AdminMenuRequest $request, $id)
    {
        $this->repository->updateTree($id, $request->get('tree'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function nested(AdminMenuRequest $request, $parent = 1)
    {
        $parent = $this->repository->all();
    }

}
