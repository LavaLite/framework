<?php

namespace Litepie\Team;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Litepie\Team\Traits\TeamTrait;

class Team extends Model
{
    use TeamTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * @var array
     */
    protected $fillable = ['name', 'owner_id'];

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('team.teams_table');
    }
}
