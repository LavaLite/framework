<?php

namespace Litepie\Menu\Repositories\Eloquent;

use Litepie\Menu\Interfaces\MenuRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

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

    public function updateTree($id, $json)
    {
        $tree             = json_decode($json, true);
        $this->tempHolder = [];
        $this->getParentChild($id, $tree);

        foreach ($this->tempHolder as $parent => $children) {

            foreach ($children as $key => $val) {
                $this->update(['parent_id' => $parent, 'order' => $key], $val);
            }

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

        $model         = $this->find($id);
        $originalModel = clone $model;

        $this->skipPresenter($_skipPresenter);
        $this->resetModel();

        $deleted = $model->delete();

        event(new RepositoryEntityDeleted($this, $originalModel));

        return $deleted;
    }
    /**
     * Delete a entity in repository by id.
     *
     * @param $id
     *
     * @return int
     */
    public function getMenu($key)
    {
        return $menus = $this->orderBy('order', 'ASC')
        ->all()
        ->toMenu($key);
    }
}
