<?php

namespace Litepie\Menu;
use Litepie\Menu\Interfaces\MenuRepositoryInterface;

class Menu
{
    protected $model;

    public function __construct(MenuRepositoryInterface $menu)
    {
        $this->model = $menu;
    }

    public function model()
    {
        return $this->model->getModel();
    }

    public function menu($key, $view = null)
    {
        $menus = $this->model->scopeQuery(function ($query) {
            return $query->orderBy('order', 'ASC');
        })->all()->toMenu($key);

        if (is_null($view)) {
            $view = 'menu::menu.' . $key;
        }

        if (!view()->exists($view)) {
            $view = 'menu::menu.default';
        }

        return view($view, compact('menus'));
    }

    public function select($key, $view = 'menu::menu.default')
    {
        $menu = $this->model->getAllSubMenus($key);

        return view("menu.$view", compact('menu'));
    }

}
