<?php

namespace Mpociot\Teamwork\Traits;

/*
 * This file is part of Teamwork
 *
 * @license MIT
 * @package Teamwork
 */

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

trait TeamTrait
{
    /**
     * One-to-Many relation with the invite model.
     *
     * @return mixed
     */
    public function invites()
    {
        return $this->hasMany(config('team.invite_model'), 'team_id', 'id');
    }

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('team.user_model'), config('team.team_user_table'), 'team_id', 'user_id')->withTimestamps();
    }

    /**
     * Has-One relation with the user model.
     * This indicates the owner of the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function owner()
    {
        $userModel = config('team.user_model');
        $userKeyName = ( new $userModel() )->getKeyName();

        return $this->hasOne(config('team.user_model'), $userKeyName, 'owner_id');
    }

    /**
     * Helper function to determine if a user is part
     * of this team.
     *
     * @param Model $user
     *
     * @return bool
     */
    public function hasUser(Model $user)
    {
        return $this->users()->where($user->getKeyName(), '=', $user->getKey())->first() ? true : false;
    }
}
