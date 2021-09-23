<?php

namespace Litepie\User\Repositories\Eloquent\Presenters;

use Litepie\Repository\Presenter\Presenter;

class UserItemPresenter extends Presenter
{
    public function itemLink()
    {
        return guard_url('users/user').'/'.$this->getRouteKey();
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

    public function toArray()
    {
        return [
            'id'                => $this->getRouteKey(),
            'title'             => $this->title(),
            'reporting_to'      => $this->reporting_to,
            'team_id'           => $this->team_id,
            'name'              => $this->name,
            'email'             => $this->email,
            'password'          => $this->password,
            'api_token'         => $this->api_token,
            'remember_token'    => $this->remember_token,
            'sex'               => $this->sex,
            'dob'               => $this->dob,
            'doj'               => $this->doj,
            'designation'       => $this->designation,
            'mobile'            => $this->mobile,
            'phone'             => $this->phone,
            'address'           => $this->address,
            'street'            => $this->street,
            'city'              => $this->city,
            'district'          => $this->district,
            'state'             => $this->state,
            'country'           => $this->country,
            'photo'             => $this->photo,
            'web'               => $this->web,
            'urls'              => $this->urls,
            'status'            => $this->status,
            'email_verified_at' => $this->email_verified_at,
            'user_id'           => $this->user_id,
            'user_type'         => $this->user_type,
            'upload_folder'     => $this->upload_folder,
            'created_at'        => !is_null($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at'        => !is_null($this->updated_at) ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'meta'              => [
                'exists'     => $this->exists(),
                'link'       => $this->itemLink(),
                'upload_url' => $this->getUploadURL(''),
            ],
        ];
    }
}
