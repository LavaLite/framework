<?php

namespace Litepie\Menu\Http\Controllers;

namespace Litepie\Menu\Http\Controllers;

use Form;
use Litepie\Http\Controllers\ResourceController as BaseController;
use Litepie\Menu\Forms\Menu as MenuForm;
use Litepie\Menu\Http\Requests\MenuRequest;
use Litepie\Menu\Interfaces\MenuRepositoryInterface;
use Litepie\Menu\Models\Menu;
use Response;

class MenuResourceController extends BaseController
{
    /**
     * Initialize page controller.
     *
     * @param type PageRepositoryInterface $page
     *
     * @return type
     */
    public function __construct(MenuRepositoryInterface $menu)
    {
        parent::__construct();
        $this->form = MenuForm::setAttributes()->toArray();
        $this->modules = $this->modules(config('menu.modules'), 'menu', guard_url('menu'));
        $this->repository = $menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MenuRequest $request, $parent = 1)
    {
        $pageLimit = $request->input('pageLimit', 10);

        $parent = $this->repository->find(hashids_encode($parent));
        $rootMenu = $this->repository->rootMenues();

        $form = $this->form;
        $modules = $this->modules;

        return $this->response->setMetaTitle(trans('menu::menu.names'))
            ->view('litepie.menu.admin.list')
            ->data(compact('rootMenu', 'parent', 'modules', 'form'))
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
    public function show(MenuRequest $request, $parent = 1)
    {
        if ($request->ajax()) {
            $menu = $parent->getModel();

            Form::populate($menu);

            return view('litepie.menu.admin.show', compact('menu'));
        }

        $rootMenu = $this->repository->rootMenues();

        return $this->response->setMetaTitle(trans('menu::menu.names'))
            ->view('litepie.menu.admin.index')
            ->data(compact('rootMenu', 'parent'))
            ->output();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(MenuRequest $request, MenuRepositoryInterface $menu)
    {
        $menu = $this->repository->newInstance([]);

        Form::populate($menu);

        return view('litepie.menu.admin.create', compact('menu'));
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
            $menu = $this->repository->create($attributes);
            $menu = $menu->getModel();

            return $this->response
                ->message(trans('messages.success.created', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('menu/menu/'.$menu->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response
                ->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/menu'))
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
        $data['menu'] = $menu->getModel();
        Form::populate($data['menu']);

        return view('litepie.menu.admin.edit', $data);
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
            $menu = $menu->getModel();

            return $this->response->message(trans('messages.success.updated', ['Module' => trans('menu::menu.name')]))
                ->code(204)
                ->status('success')
                ->url(guard_url('menu/menu/'.$menu->getRouteKey()))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/menu/'.$menu->getRouteKey()))
                ->redirect();
        }
    }

    /**
     * Remove the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(MenuRequest $request, MenuRepositoryInterface $menu)
    {
        $cid = $menu->id;

        if ($this->repository->where('parent_id', $cid)->count() > 0) {
            return response()->json([
                'message' => 'Child menu exists.',
                'type'    => 'warning',
                'title'   => 'Warning',
            ], 409);
        }
        $data = $menu->toArray();

        try {
            $menu->delete();

            return $this->response->message(trans('messages.success.deleted', ['Module' => trans('menu::menu.name')]))
                ->code(202)
                ->status('success')
                ->url(guard_url('menu/menu/'.$data['id']))
                ->redirect();
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())
                ->code(400)
                ->status('error')
                ->url(guard_url('menu/menu/'.$data['id']))
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
    public function tree(MenuRequest $request, $id)
    {
        $this->repository->updateTree($id, $request->get('tree'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function nested(MenuRequest $request, $parent = 1)
    {
        $parent = $this->repository->all();
    }
}
