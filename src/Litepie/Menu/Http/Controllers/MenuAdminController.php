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

    public function __construct(\Litepie\Contracts\Menu\MenuRepository $menu)
    {
        $this->model = $menu;

        $this->view = config('menu.menu.view.admin');

        parent::__construct();
    }

    public function index(MenuRequest $request, $parent = 1)
    {
        $parent = $this->model->find(hashids_encode($parent));
        $rootMenu = $this->model->rootMenues();

        $this->theme->prependTitle(trans('menu::menu.names').' :: ');

        $this->theme->asset()->container('footer')->add('nestable', 'packages/nestable/jquery.nestable.js');

        return $this->theme->of('menu::admin.index', compact('rootMenu', 'parent'))->render();
    }

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

    public function create(MenuRequest $request)
    {
        $menu = $this->model->newInstance();

        Form::populate($menu);

        return  view('menu::admin.create', compact('menu'));
    }

    public function store(MenuRequest $request)
    {
        try {
            $row = $this->model->create($request->all());

            return Response::json(['message' => 'Menu created sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    public function edit(MenuRequest $request, $id)
    {
        $data['menu'] = $this->model->find($id);
        Form::populate($data['menu']);

        return  view('menu::admin.edit', $data);
    }

    public function update(MenuRequest $request, $id)
    {
        try {
            $row = $this->model->update($request->all(), $id);

            return Response::json(['message' => 'Menu updated sucessfully', 'type' => 'success', 'title' => 'Success'], 201);
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage(), 'type' => 'error', 'title' => 'Error'], 400);
        }
    }

    public function destroy(MenuRequest $request, $id)
    {
        if ($this->model->where('parent_id', '=', $id)->exists()) {
            return Response::json(['message' => 'Child menu exists.', 'type' => 'warning', 'title' => 'Warning'], 400);
        }

        try {
            $this->model->delete($id);

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
