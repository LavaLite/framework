<?php

namespace Litepie\User\Traits;


/**
 * Trait HasPermission.
 */
trait UserModel
{
    /**
     * Get all of the staff member's photos.
     */
    public function user()
    {
        return $this->morphTo();
    }


}
