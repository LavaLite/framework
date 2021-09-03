<?php

namespace Litepie\Menu\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Database\Model;
use Litepie\Database\Traits\Sluggable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Node\Traits\SimpleNode;
use Litepie\Trans\Traits\Translatable;

class Menu extends Model
{
    use Hashids;
    use Sluggable;
    use Translatable;
    use SoftDeletes;
    use Filer;
    use SimpleNode;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'menu.menu.model';

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
}
