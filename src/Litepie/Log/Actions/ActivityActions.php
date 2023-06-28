<?php

namespace Litepie\Log\Actions;

use Illuminate\Support\Str;
use Litepie\Log\Models\Activity;
use Litepie\Log\Scopes\ActivityResourceScope;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;

class ActivityActions
{
    use AsAction;
    use LogsActions;
    
    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(Activity::class);

        $function = Str::camel($action);

        event('log.activity.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('log.activity.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;

    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $activity = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new ActivityResourceScope())
            ->paginate($pageLimit);

        return $activity;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $activity = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new ActivityResourceScope())
            ->simplePaginate($pageLimit);

        return $activity;
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
