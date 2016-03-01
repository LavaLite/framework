<?php

namespace Litepie\Menu\Http\Controllers;

use App\Http\Controllers\AdminController as AdminController;
use Form;
use Litepie\Menu\Http\Requests\MenuRequest;
use Litepie\Menu\Models\Menu as Menu;
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
    public function index(MenuRequest $request, $parent = 1)
    {
        $parent = $this->repository->find(hashids_encode($parent));
        $rootMenu = $this->repository->rootMenues();

        $this->theme->prependTitle(trans('menu.names').' :: ');

        $this->theme->asset()->container('footer')->add('nestable', 'packages/nestable/jquery.nestable.js');

        return $this->theme->of('Menu::index', compact('rootMenu', 'parent'))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function nested(MenuRequest $request, $parent = 1)
    {
        $parent = $this->repository->all();
        print_r($parent->toMenu('admin'));
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
        if ($request->ajax()) {
            $menu = $this->repository->find($id);

            Form::populate($menu);

            return view('Menu::show', compact('menu'));
        }
        $parent = $this->repository->find($id);
        $rootMenu = $this->repository->rootMenues();
        $this->theme->asset()->container('footer')->add('nestable', 'packages/nestable/jquery.nestable.js');

        $this->theme->prependTitle(trans('Menu::menu.names').' :: ');

        return $this->theme->of('Menu::index', compact('rootMenu', 'parent'))->render();
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
        $menu = $this->repository->newInstance();

        Form::populate($menu);

        return  view('Menu::create', compact('menu'));
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
            $menu = $this->repository->create($attributes);

            $this->responseCode = 201;
            $this->responseMessage = trans('messages.success.created', ['Module' => trans('menu::menu.name')]);
            $this->responseData = $menu;
            $this->responseRedirect = trans_url('/admin/menu/menu/'.$menu->getRouteKey());
            $this->responseView = view('menu::admin.menu.create', compact('menu'));

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
        $data['menu'] = $this->repository->find($id);
        Form::populate($data['menu']);

        return  view('Menu::edit', $data);
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
            $this->responseData = $menu;
            $this->responseRedirect = trans_url('/admin/menu/menu/'.$menu->getRouteKey());

            return $this->respond($request);
        } catch (Exception $e) {
            $this->responseCode = 400;
            $this->responseMessage = $e->getMessage();
            $this->responseRedirect = trans_url('/admin/menu/menu/'.$menu->getRouteKey());

            return $this->respond($request);
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(MenuRequest $request, $id)
    {
        $cid = hashids_decode($id);
        if ($this->repository->findByField('parent_id', $cid)->count() > 0) {
            return Response::json(['message' => 'Child menu exists.', 'type' => 'warning', 'title' => 'Warning'], 409);
        }

        try {
            $menu = $this->repository->find($id);
            $menu->delete();

            return Response::json(['message' => 'Menu deleted sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    public function tree(MenuRequest $request, $id)
    {
        $this->repository->updateTree($id, $request->get('tree'));
    }
}
