<?php

namespace Litepie\User\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\User\Models\User;

class UserAction
{
    use AsAction;

    protected $model;
    protected $namespace = 'litepie.user.user';
    protected $eventClass = \Litepie\User\Events\UserAction::class;
    protected $action;
    protected $function;
    protected $request;

    public function handle(string $action, User $user, array $request = [])
    {
        $this->action = $action;
        $this->request = $request;
        $this->model = $user;
        $this->function = Str::camel($action);
        $this->executeAction();

        // return $this->model;
        return $this->result;
    }

    public function store(User $user, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['password'] = bcrypt($request['password']);
        $user = $user->create($attributes);

        return $user;
    }

    public function update(User $user, array $request)
    {
        $attributes = $request;
        if (isset($attributes['roles'])) {
            $user->roles()->sync($attributes['roles']);
        }
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($request['password']);
        }
        $user->update($attributes);

        return $user;
    }

    public function delete(User $user, array $request)
    {
        $id = hashids_decode($request['parent_id']);
        $userWithProperty = $this->model->where('id', $id)->has('property')->count();
        if ($userWithProperty > 0) {
            throw new \Exception('Cannot delete user with associated property');
        }
        $userWithOpportunity = $this->model->where('id', $id)->has('opportunity')->count();
        if ($userWithOpportunity > 0) {
            throw new \Exception('Cannot delete user with associated opportunity');
        }
        $deleted = $this->model->where('id', $id)->delete();
        if (!$deleted) {
            throw new \Exception('Failed to delete user.');
        }

        return $deleted;
    }

    public function copy(User $user, array $request)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $user = $user->replicate();
            $user->created_at = Carbon::now();
            $user->save();

            return $user;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $user->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $user;
    }
}
