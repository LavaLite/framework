<?php

namespace Litepie\Role\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Notification\Traits\SendNotification;
use Litepie\Role\Models\Permission;


class PermissionAction
{
    use AsAction;
    use LogsActions;
    use SendNotification;

    private $model;

    public function handle(string $action, Permission $permission, array $request = [])
    {
        $this->model = $permission;

        $function = Str::camel($action);
        event('role.permission.action.' . $action . 'ing', [$permission]);
        $data =  $this->$function($permission, $request);
        event('role.permission.action.' . $action . 'ed', [$permission]);

        $this->logsAction();
        $this->notify();
        return $data;
    }


    public function store(Permission $permission, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $permission = $permission->create($attributes);
        return $permission;
    }

    public function update(Permission $permission, array $request)
    {
        $attributes = $request;
        $permission->update($attributes);
        return $permission;
    }

    public function destroy(Permission $permission, array $request)
    {
        $permission->delete();
        return $permission;
    }

    public function copy(Permission $permission, array $request)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $permission = $permission->replicate();
            $permission->created_at = Carbon::now();
            $permission->save();
            return $permission;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $permission->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $permission;
    }


}
