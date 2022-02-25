<?php

namespace Litepie\User\Traits;

/**
 * Trait HasPermission.
 */
trait User
{


    /**
     * Returns the profile picture of the user.
     *
     * @return string image path
     */
    public function getPictureAttribute($value)
    {
        if (!empty($this->photo)) {
            return url($this->defaultImage('photo'));
        }

        if ($this->sex == 'female') {
            return asset('img/avatar/female.png');
        }

        return asset('img/avatar/male.png');
    }


    /**
     * Returns the joined date of the user.
     *
     * @return string date
     */
    public function getJoinedAttribute()
    {
        return format_date($this->created_at, 'd M Y');
    }

    /**
     * Returns the whrether auser is active or not.
     *
     * @return string date
     */
    public function getIsActiveAttribute()
    {
        return $this->status == 'Active';
    }

    /**
     * Returns the whrether auser is active or not.
     *
     * @return string date
     */
    public function getIsNewAttribute()
    {
        return $this->status == 'New';
    }

    /**
     * Returns the whrether auser is active or not.
     *
     * @return string date
     */
    public function getIsLockedAttribute()
    {
        return $this->status != 'New' && $this->status != 'Active';
    }
}
