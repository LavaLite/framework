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
        $this->model = $menu;
        $this->view = config('menu.view');
        parent::__construct();
    }

    public function show(MenuRequest $request, $id)
    {
        $menu = $this->model->findOrNew($id);
        Form::populate($menu);

        return view($this->view.'sub.show', compact('parent', 'menu'));
    }

    public function create(MenuRequest $request)
    {
        $menu = $this->model->findOrNew(0);
        $menu->parent_id = $request->get('parent_id', 0);

        Form::populate($menu);

        return view($this->view.'sub.create', compact('menu'));
    }

    public function edit(MenuRequest $request, $id)
    {
        $menu = $this->model->findOrNew($id);

        Form::populate($menu);

        return view($this->view.'sub.edit', compact('menu'));
    }
}
