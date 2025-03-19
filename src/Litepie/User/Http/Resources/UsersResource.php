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
            'doj' => $this->doj,
            'dob' => $this->dob,
            'sex' => $this->sex,
            'languages' => $this->getLanguages(),
            'user_type' => $this->user_type,
            'location' => $this->getLocation(),
            'experience' => $this->experience,
            'phone' => $this->phone,
            'education' => $this->education,
            'rera' => $this->rera,
            'created_at'  => format_date($this->created_at),
            'updated_at'  => format_date($this->updated_at),
            'meta' => [
                'exists' => $this->exists(),
                'link' => $this->itemLink(),
            ],
            "logo"      => !is_null($this->getLogo('photo', 'xs')) ? $this->getLogo('photo', 'xs') : url($this->defaultImage('images', 'xs')),
        ];
    }
    public function getLogo($field, $size)
    {
        $images = $this->$field;
        if (!is_array($images) || count($images) < 1) return null;
        $logo = url('image/local/' . $size . '/' . $images[0]['folder'] . '/' . $images[0]['file']);
        return $logo ?? null;
    }
    public function getLanguages()
    {
        if ($this->languages !== null) {
            $languageNames = array_column($this->languages, 'name');
            $languagesString = implode(', ', $languageNames);

            return $languagesString;
        } else {
            return null;
        }
    }
    public function getLocation()
    {
        $locations = collect([
            $this->region ?  $this->region : null,
            $this->state ? $this->state : null,
            $this->country ? $this->country : null,
        ])->filter()->implode(', ');
        return $locations;
    }
}
