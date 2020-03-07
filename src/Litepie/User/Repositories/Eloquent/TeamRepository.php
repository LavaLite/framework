<?php

namespace Litepie\User\Repositories\Eloquent;

use Litepie\Repository\Eloquent\BaseRepository;
use Litepie\User\Interfaces\TeamRepositoryInterface;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{

    public function boot()
    {
        $this->fieldSearchable = config('users.team.model.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('users.team.model.model');
    }

    /**
     * Attach a user to a team.
     *
     * @return string
     */
    public function attach($data)
    {
        $team = $this->model->find($data['team_id']);
        $team->users()->sync([$data['user_id'] => ['role' => $data['role']]], false);
        return $team;
    }

    /**
     * Detach a user to a team.
     *
     * @return string
     */
    public function detach($data)
    {
        $team = $this->model->find($data['team_id']);
        $team->users()->detach($data['user_id']);
        return $team;
    }

    public function options($key = 'id', $value = 'name')
    {
        return $this->model
            ->select("$value as name", "$key as key")->get();
    }
    public function getAllUserForOpporunity($id)
    {
        $team = $this->model->find($id);
        $result = $team->users()->orderBy(DB::raw('((team_user.lead_count+1)/team_user.lead_weight)*100'), 'ASC')
            ->pluck('users.id');
        return $result;
    }
    public function leadCountIncrement($user_id, $team_id)
    {
        $team = $this->model->find($team_id);
        $result = $team->users()->where('team_user.user_id', $user_id)->increment('team_user.lead_count');
        return $result;
    }
}
