<?php

namespace Litepie\Team;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Litepie\Team\Traits\TeamInviteTrait;

class Invite extends Model
{
    use TeamInviteTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('team.team_invites_table');
    }
}
