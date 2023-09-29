<?php

namespace Litepie\Team\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TeamUser extends Pivot
{
    public $table = 'team_user';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'roles' => 'object',
    ];
}
