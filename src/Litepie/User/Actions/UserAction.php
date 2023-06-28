<?php

namespace Litepie\User\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Notification\Traits\SendNotification;
use Litepie\User\Models\User;


class UserAction
{
    use AsAction;
    use LogsActions;
    use SendNotification;

    private $model;

    public function handle(string $action, User $user, array $request = [])
    {
        $this->model = $user;

        $function = Str::camel($action);
        event('user.user.action.' . $action . 'ing', [$user]);
        $data =  $this->$function($user, $request);
        event('user.user.action.' . $action . 'ed', [$user]);

        $this->logsAction();
        $this->notify();
        return $data;
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
