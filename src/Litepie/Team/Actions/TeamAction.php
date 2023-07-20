<?php

namespace Litepie\Team\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Notification\Traits\SendNotification;
use Litepie\Team\Models\Team;

class TeamAction
{
    use AsAction;
    use LogsActions;
    use SendNotification;

    protected $model;
    protected $namespace = 'litepie.team.team';
    protected $eventClass = ''; //\Litepie\Team\Events\TeamAction::class;
    protected $action;
    protected $function;
    protected $request;

    public function handle(string $action, Team $team, array $request = [])
    {
        $this->action = $action;
        $this->request = $request;
        $this->model = $team;
        $this->function = Str::camel($action);
        $this->executeAction();
        return $this->model;
    }

    public function store(Team $team, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $team = $team->create($attributes);
        return $team;
    }

    public function update(Team $team, array $request)
    {
        $attributes = $request;
        $team->update($attributes);
        return $team;
    }

    public function destroy(Team $team, array $request)
    {
        $team->delete();
        return $team;
    }

    public function copy(Team $team, array $request)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $team = $team->replicate();
            $team->created_at = Carbon::now();
            $team->save();
            return $team;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $team->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $team;
    }

    /**
     * Attach a user to a team.
     *
     * @return string
     */
    public function attach(Team $team, array $data)
    {
        $this->detach($team, $data);
        $team->users()->attach($data['user_id'], ['level' => $data['level']]);
        return $team;
    }

    /**
     * Detach a user to a team.
     *
     * @return string
     */
    public function detach(Team $team, array $data)
    {
        $team->users()->updateExistingPivot($data['user_id'], ['deleted_at' => now()]);

        return $team;
    }
}
