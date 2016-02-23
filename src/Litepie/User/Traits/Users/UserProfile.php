<?php

namespace Litepie\User\Traits\Users;

use URL;

/**
 * Trait UserProfile.
 */
trait UserProfile
{
    /**
     * Returns the profile picture of the user.
     *
     * @return string image path
     */
    public function getPictureAttribute($value)
    {
        if (!empty($value)) {
            $photo = json_encode($value);

            return URL::to($photo['folder'].'/'.$photo['file']);
        }

        if ($this->sex == 'Female') {
            return URL::to('img/avatar/female.png');
        }

        return URL::to('img/avatar/male.png');
    }

    /**
     * Returns the joined date of the user.
     *
     * @return string date
     */
    public function getJoinedAttribute()
    {
        return $this->created_at->format(config('cms.format.date'));
    }
}
