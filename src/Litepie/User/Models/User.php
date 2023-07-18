<?php

namespace Litepie\User\Models;

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

class User extends Model
{
    use Filer;
    use Hashids;
    use Sluggable;
    use SoftDeletes;
    use Sortable;
    use Translatable;
    use Scopable;
    use Actionable;
    use Searchable;
    use Workflowable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'user.user.model';

    public function getSettings()
    {
        $settings = [
            'groups' => [],
            'fields' => [],
        ];
        $settings['groups']['login_details'] = ['show' => true, 'edit' => true];
        $settings['groups']['main'] = ['show' => true, 'edit' => true];
        $settings['groups']['details'] = ['show' => true, 'edit' => true];
        $settings['groups']['photo'] = ['show' => true, 'edit' => true];
        $settings['groups']['roles'] = ['show' => true, 'edit' => true];
        $settings['fields']['password'] = ['show' => true, 'edit' => true, 'disabled' => !is_null($this->password)];
        $settings['groups']['company'] = ['show' => true, 'edit' => true];
        return $settings;
    }
}
