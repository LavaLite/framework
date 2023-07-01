<?php

namespace Litepie\User\Actions;

use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;
use Litepie\User\Models\Client;
use Litepie\User\Scopes\ClientResourceScope;

class ClientActions
{
    use AsAction;
    use LogsActions;

    protected $model;
    protected $namespace = 'litepie.user.client';
    protected $eventClass = \Litepie\User\Events\ClientAction::class;
    protected $action;
    protected $function;
    protected $request;

    public function handle(string $action, array $request)
    {
        $this->model = app(Client::class);
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
            ->pushScope(new ClientResourceScope())
            ->take(30)->get()
            ->map(function ($row) {
                return [
                    'key' => $row->id,
                    'value' => $row->id,
                    'text' => $row->name,
                ];
            })->toArray();
    }
}
