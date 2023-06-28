<?php

namespace Litepie\Log\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Notification\Traits\SendNotification;
use Litepie\Log\Models\Action;


class ActionAction
{
    use AsAction;
    use LogsActions;
    use SendNotification;

    private $model;

    public function handle(string $action, Action $action, array $request = [])
    {
        $this->model = $action;

        $function = Str::camel($action);
        event('log.action.action.' . $action . 'ing', [$action]);
        $data =  $this->$function($action, $request);
        event('log.action.action.' . $action . 'ed', [$action]);

        $this->logsAction();
        $this->notify();
        return $data;
    }


    public function store(Action $action, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $action = $action->create($attributes);
        return $action;
    }

    public function update(Action $action, array $request)
    {
        $attributes = $request;
        $action->update($attributes);
        return $action;
    }

    public function destroy(Action $action, array $request)
    {
        $action->delete();
        return $action;
    }

    public function copy(Action $action, array $request)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $action = $action->replicate();
            $action->created_at = Carbon::now();
            $action->save();
            return $action;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $action->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $action;
    }


}
