<?php

namespace Litepie\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{

    public function itemLink()
    {
        return guard_url('user/user') . '/' . $this->getRouteKey();
    }

    public function title()
    {
        if ($this->title != '') {
            return $this->title;
        }

        if ($this->name != '') {
            return $this->name;
        }

        return 'None';
    }

    public function toArray($request)
    {
        return [
            'id' => $this->getRouteKey(),
            'title' => $this->title(),
            'name'        => $this->name,
            'email'        => $this->email,
            'description' => $this->description,
            'status'      => $this->status,
            'designation' => $this->designation,
            'image' => [
                'main' => url($this->defaultImage('images', 'xs')),
                'sub' => @$this->client->picture,
            ],
            'status' => $this->status,
            'created_at'  => format_date($this->created_at),
            'updated_at'  => format_date($this->updated_at),
            'meta' => [
                'exists' => $this->exists(),
                'link' => $this->itemLink(),
            ],
        ];
    }
}
