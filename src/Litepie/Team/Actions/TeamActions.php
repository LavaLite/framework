<?php

namespace Litepie\Team\Actions;

use Illuminate\Support\Str;
use Litepie\Team\Models\Team;
use Litepie\Team\Scopes\TeamResourceScope;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;

class TeamActions
{
    use AsAction;
    use LogsActions;

    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(Team::class);

        $function = Str::camel($action);

        event('team.team.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('team.team.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;
    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $team = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new TeamResourceScope())
            ->paginate($pageLimit);

        return $team;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $team = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new TeamResourceScope())
            ->simplePaginate($pageLimit);

        return $team;
    }

    function empty(array $request)
    {
        return $this->model->forceDelete();
    }

    function restore(array $request)
    {
        return $this->model->restore();
    }

    public function delete(array $request)
    {
        $ids = $request['ids'];
        $ids = collect($ids)->map(function ($id) {
            return hashids_decode($id);
        });
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function options(array $request)
    {
        return $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new TeamResourceScope())
            ->take(30)->get()
            ->map(function ($row) {
                return [
                    'key' => $row->id,
                    'value' => $row->id,
                    'text' => $row->name,
                    'name' => $row->name,
                ];
            })->toArray();
    }
}
