<?php

namespace Litepie\User\Actions;

use Illuminate\Support\Str;
use Litepie\User\Models\Client;
use Litepie\User\Scopes\ClientResourceScope;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;

class ClientActions
{
    use AsAction;
    use LogsActions;
    
    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(Client::class);

        $function = Str::camel($action);

        event('user.client.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('user.client.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;

    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $client = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new ClientResourceScope())
            ->paginate($pageLimit);

        return $client;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $client = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new ClientResourceScope())
            ->simplePaginate($pageLimit);

        return $client;
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
