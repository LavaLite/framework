<?php

namespace Litepie\Role\Actions;

use Illuminate\Support\Str;
use Litepie\Role\Models\Role;
use Litepie\Role\Scopes\RoleResourceScope;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\Scopes\RequestScope;

class RoleActions
{
    use AsAction;
    use LogsActions;

    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(Role::class);

        $function = Str::camel($action);

        event('role.role.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('role.role.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;
    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $role = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new RoleResourceScope())
            ->paginate($pageLimit);

        return $role;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $role = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new RoleResourceScope())
            ->simplePaginate($pageLimit);

        return $role;
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
    private function select($request)
    {
        return $this->model->pluck('name', 'id')->all();
    }
    public function options(array $request)
    {
        return  $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new RoleResourceScope())
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
