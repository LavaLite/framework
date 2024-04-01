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
use Litepie\Log\Traits\LogsActivity;
use Litepie\Role\Models\Role;

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
    use LogsActivity;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'user.user.model';
    public function property()
    {
        return $this->hasMany('Bixo\Product\Models\Property', 'assign_to');
    }
    public function opportunity()
    {
        return $this->hasMany('Bixo\Opportunity\Models\Opportunity', 'agent_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getSettings()
    {
        $settings = [
            'groups' => [],
        ];
        $show_state = true;
        if (is_null($this->id)) {
            $show_state = false;
        }
        $settings['groups']['login_details'] = ['show' => true, 'edit' => true];
        $settings['groups']['main'] = ['show' => true, 'edit' => true];
        $settings['groups']['details'] = ['show' => true, 'edit' => true];
        $settings['groups']['photo'] = ['show' => true, 'edit' => true];
        $settings['groups']['roles'] = ['show' => true, 'edit' => true];
        $settings['fields']['password'] = ['show' => true, 'edit' => true];
        $settings['groups']['company'] = ['show' => true, 'edit' => true];
        $settings['groups']['details'] = ['show' => is_null($this->id) ? true : false, 'edit' => true];
        $settings['groups']['user_details'] = ['show' => true, 'edit' => true];
        $settings['groups']['user_login_details'] = ['show' => true, 'edit' => true];
        $settings['groups']['photo_gallery'] = ['show' => true, 'edit' => true];
        $settings['groups']['roles'] = ['show' => true, 'edit' => true];
        return $settings;
    }
}
