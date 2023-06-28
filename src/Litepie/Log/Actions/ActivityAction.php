<?php

namespace Litepie\Log\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Notification\Traits\SendNotification;
use Litepie\Log\Models\Activity;


class ActivityAction
{
    use AsAction;
    use LogsActions;
    use SendNotification;

    private $model;

    public function handle(string $action, Activity $activity, array $request = [])
    {
        $this->model = $activity;

        $function = Str::camel($action);
        event('log.activity.action.' . $action . 'ing', [$activity]);
        $data =  $this->$function($activity, $request);
        event('log.activity.action.' . $action . 'ed', [$activity]);

        $this->logsAction();
        $this->notify();
        return $data;
    }


    public function store(Activity $activity, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $activity = $activity->create($attributes);
        return $activity;
    }

    public function update(Activity $activity, array $request)
    {
        $attributes = $request;
        $activity->update($attributes);
        return $activity;
    }

    public function destroy(Activity $activity, array $request)
    {
        $activity->delete();
        return $activity;
    }

    public function copy(Activity $activity, array $request)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $activity = $activity->replicate();
            $activity->created_at = Carbon::now();
            $activity->save();
            return $activity;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $activity->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $activity;
    }


}
