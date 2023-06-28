<?php

namespace Litepie\Menu;

use Litepie\Menu\Models\Menu as MenuModel;

class Menu
{
    protected $model;

    public function __construct()
    {
        $this->model = app(MenuModel::class);
    }

    public function model()
    {
        return $this->model->getModel();
    }

    public function menu($key, $view = null)
    {
        $menus = $this->model->getMenu($key);

        if (is_null($view)) {
            $view = 'menu::menu.'.$key;
        }

        if (!view()->exists($view)) {
            $view = 'menu::menu.default';
        }

        return view($view, compact('menus'));
    }

    public function allMenus($menu)
    {
        $menu = $this->model->findByField('id', hashids_decode($menu))->first();

        return $menu->key;
    }
}
