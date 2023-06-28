<?php

namespace Litepie\Master\Actions;

use Illuminate\Support\Str;
use Litepie\Master\Models\Master;
use Litepie\Master\Scopes\MasterResourceScope;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;

class MasterActions
{
    use AsAction;
    use LogsActions;

    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(Master::class);

        $function = Str::camel($action);

        event('master.master.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('master.master.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;

    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $master = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new MasterResourceScope())
            ->paginate($pageLimit);

        return $master;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = $request['pageLimit'] ?: config('database.pagination.limit');
        $master = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new MasterResourceScope())
            ->simplePaginate($pageLimit);

        return $master;
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

    /**
     * Return the parent categories.
     *
     * @return string
     */
    public function groupcount()
    {
        return $this->model
            ->select(['type', \DB::raw('count(id) as count')])
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();
    }

    /**
     * Return the parent categories.
     *
     * @return string
     */
    public function groups()
    {
        return collect(config('master.masters'))
        ->map(function($arr, $key){
            $arr['label'] = trans("master::master.masters.$key");
            return $arr;
        })
        ->groupBy('group')
        ->map(function($arr, $key){
            $ar['items'] = $arr->toArray();
            $ar['label'] = trans("master::master.groups.$key");
            return $ar;
        })->toArray();
    }

}
