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
        $this->model = $menu;

        $this->view = config('menu.menu.view.admin');

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(MenuRequest $request, $parent = 1)
    {
        $parent = $this->model->find(hashids_encode($parent));
        $rootMenu = $this->model->rootMenues();

        $this->theme->prependTitle(trans('menu::menu.names').' :: ');

        $this->theme->asset()->container('footer')->add('nestable', 'packages/nestable/jquery.nestable.js');

        return $this->theme->of('menu::admin.index', compact('rootMenu', 'parent'))->render();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function nested(MenuRequest $request, $parent = 1)
    {
        $parent = $this->model->all();
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
            $menu = $this->model->find($id);

            Form::populate($menu);

            return view('menu::admin.show', compact('menu'));
        }
        $parent = $this->model->find($id);
        $rootMenu = $this->model->rootMenues();
        $this->theme->asset()->container('footer')->add('nestable', 'packages/nestable/jquery.nestable.js');

        $this->theme->prependTitle(trans('menu::menu.names').' :: ');

        return $this->theme->of('menu::admin.index', compact('rootMenu', 'parent'))->render();
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
        $menu = $this->model->newInstance();

        Form::populate($menu);

        return  view('menu::admin.create', compact('menu'));
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
            $row = $this->model->create($request->all());

            return Response::json(['message' => 'Menu created sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
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
        $data['menu'] = $this->model->find($id);
        Form::populate($data['menu']);

        return  view('menu::admin.edit', $data);
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
            $row = $this->model->update($request->all(), $id);

            return Response::json(['message' => 'Menu updated sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
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
        if ($this->model->findByField('parent_id', $cid)->count() > 0) {
            return Response::json(['message' => 'Child menu exists.', 'type' => 'warning', 'title' => 'Warning'], 400);
        }

        try {
            $menu = $this->model->find($id);
            $menu->delete();

            return Response::json(['message' => 'Menu deleted sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    public function tree(MenuRequest $request, $id)
    {
        $this->model->updateTree($id, $request->get('tree'));
    }
}
