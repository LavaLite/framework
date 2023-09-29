<?php

namespace Litepie\Role\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Role\Models\Role;


class RoleAction
{
    use AsAction;

    protected $model;
    protected $namespace = 'litepie.role.role';
    protected $eventClass = \Litepie\Role\Events\RoleAction::class;
    protected $action;
    protected $function;
    protected $request;

    public function handle(string $action, Role $role, array $request = [])
    {
        $this->action = $action;
        $this->request = $request;
        $this->model = $role;
        $this->function = Str::camel($action);
        $this->executeAction();
        return $this->model;

    }


    public function store(Role $role, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $role = $role->create($attributes);
        return $role;
    }

    public function update(Role $role, array $request)
    {
        $attributes = $request;
        $role->update($attributes);
        return $role;
    }

    public function destroy(Role $role, array $request)
    {
        $role->delete();
        return $role;
    }

    public function copy(Role $role, array $request)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $role = $role->replicate();
            $role->created_at = Carbon::now();
            $role->save();
            return $role;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $role->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $role;
    }


}