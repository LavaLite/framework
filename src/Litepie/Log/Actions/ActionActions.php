<?php

namespace Litepie\Log\Actions;

use Illuminate\Support\Str;
use Litepie\Log\Models\Action;
use Litepie\Log\Scopes\ActionResourceScope;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;

class ActionActions
{
    use AsAction;
    use LogsActions;
    
    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(Action::class);

        $function = Str::camel($action);

        event('log.action.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('log.action.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;

    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $action = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new ActionResourceScope())
            ->paginate($pageLimit);

        return $action;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $action = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new ActionResourceScope())
            ->simplePaginate($pageLimit);

        return $action;
    }

    function empty(array $request) {
        return $this->model->forceDelete();
    }

    function restore(array $request) {
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
}
