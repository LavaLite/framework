<?php

/**
 * This file is part of Team.
 *
 * @license MIT
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Auth Model
    |--------------------------------------------------------------------------
    |
    | This is the Auth model used by Team.
    |
    */
    'user_model' => config('auth.providers.users.model', App\User::class),

    /*
    |--------------------------------------------------------------------------
    | Team users Table
    |--------------------------------------------------------------------------
    |
    | This is the users table name used by Team.
    |
    */
    'users_table' => 'users',

    /*
    |--------------------------------------------------------------------------
    | Team Team Model
    |--------------------------------------------------------------------------
    |
    | This is the Team model used by Team to create correct relations.  Update
    | the team if it is in a different namespace.
    |
    */
    'team_model' => Lavalite\Team\Model\Team::class,

    /*
    |--------------------------------------------------------------------------
    | Team teams Table
    |--------------------------------------------------------------------------
    |
    | This is the teams table name used by Team to save teams to the database.
    |
    */
    'teams_table' => 'teams',

    /*
    |--------------------------------------------------------------------------
    | Team team_user Table
    |--------------------------------------------------------------------------
    |
    | This is the team_user table used by Team to save assigned teams to the
    | database.
    |
    */
    'team_user_table' => 'team_user',

    /*
    |--------------------------------------------------------------------------
    | User Foreign key on Team's team_user Table (Pivot)
    |--------------------------------------------------------------------------
    */
    'user_foreign_key' => 'id',

    /*
    |--------------------------------------------------------------------------
    | Team Team Invite Model
    |--------------------------------------------------------------------------
    |
    | This is the Team Invite model used by Team to create correct relations.
    | Update the team if it is in a different namespace.
    |
    */
    'invite_model' => Lavalite\Team\Model\Invite::class,

    /*
    |--------------------------------------------------------------------------
    | Team team invites Table
    |--------------------------------------------------------------------------
    |
    | This is the team invites table name used by Team to save sent/pending
    | invitation into teams to the database.
    |
    */
    'team_invites_table' => 'team_invites',
];
