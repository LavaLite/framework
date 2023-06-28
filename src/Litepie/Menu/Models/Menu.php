<?php

namespace Litepie\Menu\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\Scopable;
use Litepie\Database\Traits\Searchable;
use Litepie\Database\Traits\Sluggable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Node\Traits\SimpleNode;
use Litepie\Trans\Traits\Translatable;
use Illuminate\Support\Arr;

class Menu extends Model
{
    use Hashids;
    use Sluggable;
    use Translatable;
    use SoftDeletes;
    use Searchable;
    use Filer;
    use SimpleNode;
    use Scopable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'menu.menu.model';

    public $tempHolder;

    /*
     * Get the model that the creator belongs to.
     */
    public function owner()
    {
        return $this->morphTo(__FUNCTION__, 'user_type', 'user_id');
    }

    public function getHasRoleAttribute($value)
    {
        if (empty($this->role)) {
            return true;
        }

        if (is_array($this->role) && user()->isOne($this->role)) {
            return true;
        }

        return false;
    }

    public function parentRouteKey()
    {
        return hashids_encode($this->parent_id);
    }

    /**
     * Select root menu.
     *
     * @return result
     */
    public function rootMenues()
    {
        return $this
            ->whereParentId(0)
            ->get();

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
        $t = $this
            ->orderBy('order', 'ASC')
            ->get()
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
