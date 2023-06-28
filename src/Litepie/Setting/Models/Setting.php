<?php

namespace Litepie\Setting\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Actions\Traits\Actionable;
use Litepie\Database\Model;
use Litepie\Database\Traits\Scopable;
use Litepie\Database\Traits\Searchable;
use Litepie\Database\Traits\Sluggable;
use Litepie\Database\Traits\Sortable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Translatable;
use Litepie\Workflow\Traits\Workflowable;

class Setting extends Model
{
    use Filer;
    use Hashids;
    use Sortable;
    use Translatable;
    use Searchable;
    use Scopable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
     protected $config = 'setting.setting.model';


    public function scopeGroup($query, $groupName)
    {
        return $query->whereGroup($groupName);
    }
}
