<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\Repository\Eloquent\BaseRepository;
use Litepie\User\Interfaces\TeamRepositoryInterface;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
    /**
     * @var array
     */
    public function boot()
    {
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $this->fieldSearchable = config('litepie.user.user.search');

        return config('litepie.user.team.model');
    }

    /**
     * Find a agents.
     *
     * @param type $id
     *
     * @return type
     */
    public function reportingTo($team_id)
    {
        $temp = [];
        $team = $this->model->select('id', 'name', 'manager_id')->whereId($team_id)->first();
        foreach ($team->member as $key => $value) {
            $temp[$value->pivot->user_id] = $value->name;
        }

        return $temp;
    }
}
