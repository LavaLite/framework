<?php

namespace Litepie\Master\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Litepie\Master\Models\Master;
use Litepie\Actions\Concerns\AsAction;

class MasterAction
{
    use AsAction;

    private $model;

    public function handle(string $action, Master $master, array $request = [])
    {
        $this->model = $master;

        $function = Str::camel($action);
        event('master.master.action.' . $action . 'ing', [$master]);
        $data =  $this->$function($master, $request);
        event('master.master.action.' . $action . 'ed', [$master]);

        $this->logsAction();
        $this->notify();
        return $data;
    }


    public function store(array $request, Master $master)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $master = $master->create($attributes);
        return $master;
    }

    public function update(array $request, Master $master)
    {
        $attributes = $request;
        $master->update($attributes);
        return $master;
    }

    public function delete(array $request, Master $master)
    {
        $master->delete();
        return $master;
    }

    public function copy(array $request, Master $master)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $master = $master->replicate();
            $master->created_at = Carbon::now();
            $master->save();
            return $master;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $master->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $master;
    }


}
