<?php

namespace Litepie\Team;

/*
 *
 * Part of the Litepie package.
 *
 *
 * @package    Team
 * @version    5.1.0
 */

use Litepie\Team\Interfaces\TeamRepositoryInterface;

/**
 * team wrapper class.
 */
class Team
{
    /**
     * @var Team repository variable
     */
    protected $team;

    /**
     *  Initialize Teams.
     *
     * @param \Litepie\Contracts\TeamRepositoryInterface $team
     *
     * @return void
     */
    public function __construct(
        TeamRepositoryInterface $team
    ) {
        $this->team = $team;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function teams()
    {
        return $this->team->pluck('name', 'id')->all();
    }
}
