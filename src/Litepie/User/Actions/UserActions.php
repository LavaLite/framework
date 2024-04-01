<?php

namespace Litepie\User\Actions;

use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;
use Litepie\User\Models\User;
use Litepie\User\Scopes\UserResourceScope;

class UserActions
{
    use AsAction;
    use LogsActions;

    protected $model;
    protected $namespace = 'litepie.user.user';
    protected $eventClass = \Litepie\User\Events\UserAction::class;
    protected $action;
    protected $function;
    protected $request;

    public function handle(string $action, array $request)
    {
        $this->model = app(User::class);
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

    function empty(array $request)
    {
        return $this->model->forceDelete();
    }

    public function restore(array $request)
    {
        return $this->model->restore();
    }

    public function delete(array $request)
    {
        $ids = $request['parent_id'];
        $ids = collect($ids)->map(function ($id) {
            return hashids_decode($id);
        });
        $userWithProperty = $this->model->whereIn('id', $ids)->has('property')->count();
        if($userWithProperty > 0){
            throw new \Exception('Cannot delete user with associated property');
        }
        $userWithOpportunity = $this->model->whereIn('id', $ids)->has('opportunity')->count();
        if($userWithOpportunity > 0){
            throw new \Exception('Cannot delete user with associated opportunity');
        }
        $deleted = $this->model->whereIn('id', $ids)->delete();
        if (!$deleted) {
            throw new \Exception('Failed to delete user.');
        }
        return $deleted;
    }

    public function options(array $request)
    {
        return $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new UserResourceScope())
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
    public function getUserByRole(array $request)
    {
        $role = @$request['role'];
        $select =  @$request['columns'];
        return  $this->model
            ->select($select)
            ->whereHas(
                'roles',
                function ($q) use ($role) {
                    $q->where('name', $role)->orWhere('slug', $role);
                }
            )
            ->get()
            ->map(function ($row) {
                $row['key'] = $row->eid;
                $row['value'] = $row->eid;
                return $row;
            });
    }
}
