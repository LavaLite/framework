<?php

namespace Litepie\User\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Notification\Traits\SendNotification;
use Litepie\User\Models\Client;


class ClientAction
{
    use AsAction;
    use LogsActions;
    use SendNotification;

    private $model;

    public function handle(string $action, Client $client, array $request = [])
    {
        $this->model = $client;

        $function = Str::camel($action);
        event('user.client.action.' . $action . 'ing', [$client]);
        $data =  $this->$function($client, $request);
        event('user.client.action.' . $action . 'ed', [$client]);

        $this->logsAction();
        $this->notify();
        return $data;
    }


    public function store(Client $client, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $client = $client->create($attributes);
        return $client;
    }

    public function update(Client $client, array $request)
    {
        $attributes = $request;
        $client->update($attributes);
        return $client;
    }

    public function destroy(Client $client, array $request)
    {
        $client->delete();
        return $client;
    }

    public function copy(Client $client, array $request)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $client = $client->replicate();
            $client->created_at = Carbon::now();
            $client->save();
            return $client;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $client->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $client;
    }


}
