<?php

namespace Litepie\Menu\Http\Controllers;

use App\Http\Controllers\AdminWebController as AdminController;
use Form;
use Litepie\Menu\Http\Requests\AdminMenuWebRequest;
use Litepie\Menu\Models\Menu;
use Response;

class MenuAdminWebController extends AdminController
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
    public function index(AdminMenuWebRequest $request, $parent = 1)
    {
        $parent   = $this->repository->find(hashids_encode($parent));
        $rootMenu = $this->repository->rootMenues();

        $this->theme->prependTitle(trans('menu.names') . ' :: ');

        $this->theme->asset()->container('footer')->add('nestable', 'packages/nestable/jquery.nestable.js');

        return $this->theme->of('menu::index', compact('rootMenu', 'parent'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function show(AdminMenuWebRequest $request, $id)
    {

        if ($request->ajax()) {
            $menu = $this->repository->find($id);

            Form::populate($menu);

            return view('menu::show', compact('menu'));
        }

        $parent   = $this->repository->find($id);
        $rootMenu = $this->repository->rootMenues();
        $this->theme->asset()->container('footer')->add('nestable', 'packages/nestable/jquery.nestable.js');

        $this->theme->prependTitle(trans('menu::menu.names') . ' :: ');

        return $this->theme->of('menu::index', compact('rootMenu', 'parent'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(AdminMenuWebRequest $request, Menu $menu)
    {
        $menu = $this->repository->newInstance([]);

        Form::populate($menu);

        return view('menu::create', compact('menu'));
    }

    /**
     * Create the specified resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(AdminMenuWebRequest $request)
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
    public function edit(AdminMenuWebRequest $request, $id)
    {
        $data['menu'] = $this->repository->find($id);
        Form::populate($data['menu']);

        return view('menu::edit', $data);
    }

    /**
     * Update the specified resource.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update(AdminMenuWebRequest $request, $id)
    {
        try {

            $attributes = $request->all();

            $menu = $this->repository->update($attributes, $id);

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
    public function destroy(AdminMenuWebRequest $request, $id)
    {
        $cid = hashids_decode($id);

        if ($this->repository->findByField('parent_id', $cid)->count() > 0) {
            return response()->json([
                'message' => 'Child menu exists.',
                'type'    => 'warning',
                'title'   => 'Warning',
            ], 409);
        }

        try {

            $menu = $this->repository->find($id);
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
     * @param AdminMenuWebRequest $request
     * @param type $id
     *
     * @return type
     */
    public function tree(AdminMenuWebRequest $request, $id)
    {
        $this->repository->updateTree($id, $request->get('tree'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function nested(AdminMenuWebRequest $request, $parent = 1)
    {
        $parent = $this->repository->all();
    }

}
