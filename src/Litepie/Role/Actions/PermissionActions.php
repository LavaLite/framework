<?php

namespace Litepie\Role\Actions;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\Scopes\RequestScope;
use Litepie\Role\Models\Permission;
use Litepie\Role\Scopes\PermissionResourceScope;

class PermissionActions
{
    use AsAction;
    use LogsActions;

    protected $model;
    protected $namespace = 'litepie.role.permission';
    protected $eventClass = \Litepie\Role\Events\PermissionAction::class;
    protected $action;
    protected $function;
    protected $request;

    public function handle(string $action, array $request)
    {
        $this->model = app(Permission::class);
        $this->action = $action;
        $this->request = $request;
        $this->function = Str::camel($action);

        $function = Str::camel($action);

        $this->dispatchActionBeforeEvent();
        $data = $this->$function($request);
        $this->dispatchActionAfterEvent();

        $this->logsAction();

        return $data;
    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $permission = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new PermissionResourceScope())
            ->paginate($pageLimit);

        return $permission;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $permission = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new PermissionResourceScope())
            ->simplePaginate($pageLimit);

        return $permission;
    }

    public function empty(array $request)
    {
        return $this->model->forceDelete();
    }

    public function restore(array $request)
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
            ->pushScope(new PermissionResourceScope())
            ->take(30)->get()
            ->map(function ($row) {
                return [
                    'key'   => $row->id,
                    'value' => $row->id,
                    'text'  => $row->name,
                ];
            })->toArray();
    }

    /**
     * Returns permissions as grouped array.
     *
     * @return mixed
     */
    public function grouped($request)
    {
        $result = $this->model->orderBy('slug')
            ->get()
            ->keyBy('slug')
            ->toArray();
        $result = Arr::undot($result);

        return $result;
    }
}
