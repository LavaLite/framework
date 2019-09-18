<?php

namespace Litepie\Team\Traits;

/*
 * This file is part of Team
 *
 * @license MIT
 * @package Team
 */

use Illuminate\Support\Facades\Config;

trait TeamInviteTrait
{
    /**
     * Has-One relations with the team model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function team()
    {
        return $this->hasOne(config('team.team_model'), 'id', 'team_id');
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->hasOne(config('team.user_model'), 'email', 'email');
    }

    /**
     * Has-One relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inviter()
    {
        return $this->hasOne(config('team.user_model'), 'id', 'user_id');
    }
}
