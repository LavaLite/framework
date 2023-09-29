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
        return $this->belongsToMany(config('user.user.model.model'))
            ->using(TeamUser::class);
    }

    public function hasRole($role, $allowSuperuser = true)
    {
        if ($allowSuperuser && user()->hasRole(['superuser'])) {
            return true;
        }

        $userRoles = $this->users()
            ->wherePivot('user_id', user_id())
            ->withPivot(['roles'])->first();

        if ($userRoles == null) {
            return false;
        }

        if ($role == '*') {
            return true;
        }

        if ($userRoles?->pivot?->roles == null) {
            return false;
        }

        return in_array($role, $userRoles->pivot->roles);
    }

    public function hasAnyRole(array $roles, $allowSuperuser = true)
    {
        if ($allowSuperuser && user()->hasRole(['superuser'])) {
            return true;
        }

        $userRoles = $this->users()
            ->wherePivot('user_id', user_id())
            ->withPivot(['roles'])->first();

        if ($userRoles == null) {
            return false;
        }

        if ($roles == ['*']) {
            return true;
        }

        if ($userRoles?->pivot?->roles == null) {
            return false;
        }

        return count(array_intersect($roles, $userRoles->pivot->roles)) > 0;
    }

    public function hasLevel($level, $allowSuperuser = true)
    {
        if ($allowSuperuser && user()->hasRole(['superuser'])) {
            return true;
        }

        $userRoles = $this->users()
            ->wherePivot('user_id', user_id())
            ->withPivot(['level'])
            ->first();

        if ($userRoles == null) {
            return false;
        }

        if ($userRoles?->pivot?->level == null) {
            return false;
        }

        return $level <= $userRoles->pivot->level;
    }

    public function isLevel($level, $allowSuperuser = true)
    {
        if ($allowSuperuser && user()->hasRole(['superuser'])) {
            return true;
        }

        $userRoles = $this->users()
            ->wherePivot('user_id', user_id())
            ->withPivot(['level'])
            ->first();

        if ($userRoles == null) {
            return false;
        }

        if ($userRoles?->pivot?->level == null) {
            return false;
        }

        return $level == $userRoles->pivot->level;
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
