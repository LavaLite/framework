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
        return $this->model;

    }

    public function store(User $user, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $user = $user->create($attributes);
        return $user;
    }

    public function update(User $user, array $request)
    {
        $attributes = $request;
        $user->update($attributes);
        return $user;
    }

    public function destroy(User $user, array $request)
    {
        $user->delete();
        return $user;
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
