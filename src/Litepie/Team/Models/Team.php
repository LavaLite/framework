<?php

namespace Litepie\Team\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Litepie\Actions\Traits\Actionable;
use Litepie\Database\Model;
use Litepie\Database\Traits\Scopable;
use Litepie\Database\Traits\Searchable;
use Litepie\Database\Traits\Sortable;
use Litepie\Filer\Traits\Filer;
use Litepie\Hashids\Traits\Hashids;
use Litepie\Trans\Traits\Translatable;
use Litepie\Workflow\Traits\Workflowable;

class Team extends Model
{
    use Filer;
    use Hashids;
    // use Sluggable;
    use SoftDeletes;
    use Sortable;
    use Translatable;
    use Searchable;
    use Scopable;
    use Actionable;
    use Workflowable;

    /**
     * Configuartion for the model.
     *
     * @var array
     */
    protected $config = 'team.team.model';

    /*
     * Get the model that the creator belongs to.
     */
    public function owner()
    {
        return $this->morphTo(__FUNCTION__, 'user_type', 'user_id');
    }
    /**
     * The User that belong to the team.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')

            ->whereNull('team_user.deleted_at') // Table `group_user` has column `deleted_at`
            ->withTimestamps()
            ->withPivot(['id', 'role', 'level']);
    }
    public function hasTeamRole($levels = [], $allowSuperuser = true)
    {
        // if ($allowSuperuser && user()->hasRole(['superuser'])) return true;
        if ($levels == ['*']) {
            return true;
        }
        $userLevels = $this->belongsToMany('App\Models\User')
            ->where('users.id', user_id())
            ->withPivot(['id', 'level'])
            ->pluck('level')
            ->toArray();
        if (is_array($levels)) {
            if (count(array_intersect(array_map('strtolower', $userLevels), array_map('strtolower', $levels))) > 0) {
                return true;
            }
        } else {
            if (in_array($levels, $userLevels)) {
                return true;
            }
        }
        return false;
    }
    public function hasTeamAccess($levels = [], $allowSuperuser = true)
    {
        if ($allowSuperuser && user()->hasRole(['superuser'])) {
            return true;
        }
        if ($levels == ['*']) {
            return true;
        }
        $userLevels = $this->belongsToMany('App\Models\User')
            ->where('users.id', user_id())
            ->withPivot(['id', 'level'])
            ->pluck('level')
            ->toArray();

        if (is_array($levels)) {
            if (count(array_intersect(array_map('strtolower', $userLevels), array_map('strtolower', $levels))) > 0) {
                return true;
            }
        } else {
            if ($userLevels) {
                if (
                    max(
                        array_map(function ($element) use ($levels) {
                            return $element >= $levels;
                        }, $userLevels),
                    )
                ) {
                    return true;
                }
            }
        }
        return false;
    }
    public function getSettings()
    {
        $settings = [
            'groups' => [],
            'fields' => [],
        ];
        $settings['groups']['main'] = ['show' => true, 'edit' => true];
        $settings['groups']['details'] = ['show' => true, 'edit' => true];
        $settings['groups']['users'] = ['show' => false, 'edit' => true];
        if ($this->exists) {
            $settings['groups']['users'] = ['show' => true, 'edit' => false];
        }
        return $settings;
    }
}
