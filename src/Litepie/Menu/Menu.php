<?php

namespace Litepie\Menu;

class Menu
{
    protected $model;

    public function __construct(\Litepie\Contracts\Menu\MenuRepository $menu)
    {
        $this->model = $menu;
    }

    public function model()
    {
        return $this->model->getModel();
    }

    public function menu($key, $view = 'menu.default')
    {
        $menu = $this->model->getAllSubMenus($key);

        return view($view, compact('menu'));
    }

    public function select($key, $view = 'menu.default')
    {
        $menu = $this->model->getAllSubMenus($key);

        return view("menu.$view", compact('menu'));
    }
}
