<?php

namespace Litepie\User\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\User\Models\Client;

class ClientAction
{
    use AsAction;

    protected $model;
    protected $namespace = 'litepie.user.client';
    protected $eventClass = \Litepie\User\Events\ClientAction::class;
    protected $action;
    protected $function;
    protected $request;

    public function handle(string $action, Client $client, array $request = [])
    {
        $this->action = $action;
        $this->request = $request;
        $this->model = $client;
        $this->function = Str::camel($action);
        $this->executeAction();
        return $this->model;

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
