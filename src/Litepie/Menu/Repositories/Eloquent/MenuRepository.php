<?php

namespace Litepie\Menu\Repositories\Eloquent;

use Illuminate\Support\Arr;
use Litepie\Menu\Interfaces\MenuRepositoryInterface;
use Litepie\Menu\Repositories\Eloquent\Presenters\MenuItemPresenter;
use Litepie\Repository\BaseRepository;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    public $tempHolder;

    public function boot()
    {
        $this->fieldSearchable = config('menu.menu.model.search');
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('menu.menu.model.model');
    }

    /**
     * Returns the default presenter if none is availabale.
     *
     * @return void
     */
    public function presenter()
    {
        return MenuItemPresenter::class;
    }

    /**
     * Select root menu.
     *
     * @return result
     */
    public function rootMenues()
    {
        $menu = $this
            ->whereParentId(0)
            ->get()
            ->getResult();
        $this->resetRepository();

        return $menu;
    }

    public function updateTree($id, $json)
    {
        $tree = json_decode($json, true);
        $this->tempHolder = [];
        $this->getParentChild($id, $tree);
        foreach ($this->tempHolder as $parent => $children) {
            foreach ($children as $key => $val) {
                $model = $this->find(hashids_decode($val));
                $model->fill(['parent_id' => $parent, 'order' => $key]);
                $model->save();
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
    public function getMenu($key)
    {
        $t = $this->resetRepository()
            ->orderBy('order', 'ASC')
            ->all()
            ->getResult()
            ->toMenu($key);

        return $t;
    }

    public function getParentChild($id, $array)
    {
        foreach ($array as $node) {
            $this->tempHolder[hashids_decode($id)][] = Arr::get($node, 'id');
            if (isset($node['children'])) {
                $this->getParentChild(Arr::get($node, 'id'), $node['children']);
            }
        }
    }
}
