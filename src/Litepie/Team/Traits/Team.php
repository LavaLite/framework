<?php

namespace Litepie\Team\Traits;

/**
 * Trait HasPermission.
 */
trait Team
{
    /**
     * The users that belong to the team.
     */
    public function users()
    {
        return $this->hasManyThrough('User\Team\Models\User');
    }

    /**
     * The member that belong to the team.
     */
    public function manager()
    {
        return $this->belongsTo('Litepie\Team\User', 'manager_id');
    }

    /**
     * The member that belong to the team.
     */
    public function member()
    {
        return $this->belongsToMany('Litepie\Team\User')->withPivot('reporting_to');
    }

    /**
     * Returns the reporting_to.
     *
     * @return string int
     */
    public function getReportedToAttribute()
    {
        $user = $this->member()
                            ->wherePivot('user_id', user_id(getenv('guard')))
                            ->first();
        if ($user->pivot->reporting_to == 0) {
            return $this->manager_id;
        }

        return $user->pivot->reporting_to;
    }
}
