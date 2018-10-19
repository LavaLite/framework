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
        $menus = $this->model->getMenu($key);

        if (is_null($view)) {
            $view = 'menu::menu.'.$key;
        }

        if (!view()->exists($view)) {
            $view = 'menu::menu.default';
        }

        return view($view, compact('menus'));
    }
}
