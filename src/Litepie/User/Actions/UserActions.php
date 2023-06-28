<?php

namespace Litepie\User\Actions;

use Illuminate\Support\Str;
use Litepie\User\Models\User;
use Litepie\User\Scopes\UserResourceScope;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;

class UserActions
{
    use AsAction;
    use LogsActions;
    
    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(User::class);

        $function = Str::camel($action);

        event('user.user.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('user.user.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;

    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $user = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new UserResourceScope())
            ->paginate($pageLimit);

        return $user;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $user = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new UserResourceScope())
            ->simplePaginate($pageLimit);

        return $user;
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
