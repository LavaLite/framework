<?php

namespace Litepie\Menu\Repository;

use Litepie\Contracts\Menu\MenuRepository as MenuRepositoryInterface;
use Litepie\Database\Eloquent\BaseRepository;
use Request;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    public $tempHolder;

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('menu.menu.model');
    }

    /**
     * Return submenu of given parent.
     *
     * @param int $parent
     *
     * @return result
     */
    public function getSubmenu($parent)
    {
        $menu = $this->model
                        ->whereParentId($parent)
                        ->get();
        $this->resetModel();

        return $menu;
    }

    /**
     * Get the breadcrumb for a menu.
     *
     * @param int $id
     *
     * @return type
     */
    public function breadscrump($id)
    {
        $this->tempHolder = [];

        $this->_breadscrump($id);

        return array_reverse($this->tempHolder);
    }

    /**
     * Select root menu.
     *
     * @return result
     */
    public function rootMenues()
    {
        $menu = $this->model
                        ->whereParentId(0)
                        ->get();
        $this->resetModel();

        return $menu;
    }

    /**
     * Return all sub menus.
     *
     * @param string $key
     *
     * @return result
     */
    public function getAllSubMenus($key)
    {
        return $this->getMenuByKey($key);
    }

    /**
     * Get sub ment by id.
     *
     * @param int $id
     *
     * @return result
     */
    public function getSubMenus($id)
    {
        $menu = $this->model
                        ->whereParentId($key)
                        ->get();
        $this->resetModel();

        return $menu;
    }

    /**
     * Get menu by id.
     *
     * @param type $id
     *
     * @return type
     */
    public function getMenuById($id)
    {
        return $this->getMenu($id);
    }

    /**
     * Get menu by key.
     *
     * @param string $key
     *
     * @return type
     */
    public function getMenuByKey($key)
    {
        $menu = $this->model
                        ->whereKey($key)
                        ->first();
        $this->resetModel();

        return $this->getMenu($menu->id);
    }

    public function getMenuId($key)
    {
        $menu = $this->model
                        ->whereKey($key)
                        ->first();
        $this->resetModel();

        return $menu->id;
    }

    public function getMenu($id)
    {
        $array = [];
        $this->_getMenu($id, $array);
        $this->setNodes($array);

        return $array;
    }

    public function _getMenu($id, &$array, $key = 0)
    {
        $menus = $this->model
                        ->whereParentId($id)
                        ->orderBy('order', 'ASC')
                        ->get();
        $this->resetModel();

        if ($menus->count() == 0) {
            return;
        }

        $i = 0;
        foreach ($menus as $menu) {
            $array[$key.'.'.++$i] = $menu;

//            if(!$menu->has_sub)
//                continue;

            $this->_getMenu($menu->id, $array, $key.'.'.$i);
        }
    }

    public function getAdminMenu($id)
    {
        $this->tempHolder = [];

        $this->_getAdminMenu($id, 1);

        return $this->tempHolder;
    }

    public function _getAdminMenu($id, $level)
    {
        $menus = $this->model
                        ->whereParentId($id)
                        ->orderBy('order', 'ASC')
                        ->get()
                        ->toArray();
        $this->resetModel();
        if (empty($menus)) {
            return;
        }

        foreach ($menus as $menu) {
            $this->tempHolder[$menu['id']] = $menu;
            $this->tempHolder[$menu['id']]['level'] = $level;
//            if(!$menu['has_sub'])
//                continue;
            $this->_getAdminMenu($menu['id'], $level + 1);
        }
    }

    public function setNodes(&$array)
    {
        $node = $this->getActiveNode($array);
        foreach ($array as $k => $v) {
            $array[$k]->root = false;
            $array[$k]->parent = false;
            $array[$k]->active = false;

            if (substr_count($k, '.') == 1) {
                $array[$k]->root = true;
            }

            if (array_key_exists($k.'.1', $array)) {
                $array[$k]->parent = true;
            }

            if ((strrpos($node, $k.'.') !== false) || ($node === $k)) {
                $array[$k]->active = true;
            }
        }
    }

    public function getActiveNode($array)
    {
        $array = array_reverse($array);
        foreach ($array as $k => $v) {
            $url = url($v->url);
            if (strrpos(Request::url(), $url) !== false) {
                return $k;
            }
        }

        return 0;
    }

    public function updateTree($id, $json)
    {
        $tree = json_decode($json, true);
        print_r($tree);
        $this->tempHolder = [];
        $this->getParentChild($id, $tree);
        foreach ($this->tempHolder as $key => $val) {
            $this->updateParent($key, $val);
        }
    }

    public function getParentChild($id, $array)
    {
        foreach ($array as $node) {
            $this->tempHolder[$id][] = array_get($node, 'id');
            if (isset($node['children'])) {
                $this->getParentChild(array_get($node, 'id'), $node['children']);
            }
        }
    }

    /**
     * Select root menu.
     *
     * @return result
     */
    public function updateParent($parent, $children)
    {
        foreach ($children as $key => $val) {
            $this->update(['parent_id' => hashids_decode($parent), 'order' => $key], hashids_decode($val));
        }
    }

    /**
     * Delete a entity in repository by id.
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        $this->applyScope();

        $_skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);
        $originalModel = clone $model;

        $this->skipPresenter($_skipPresenter);
        $this->resetModel();

        $deleted = $model->delete();

        event(new RepositoryEntityDeleted($this, $originalModel));

        return $deleted;
    }
}
