<?php

namespace Litepie\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'team_id' => $this->team_id,
            'reporting_to' => $this->reporting_to,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'api_token' => $this->api_token,
            'remember_token' => $this->remember_token,
            'sex' => $this->sex,
            'dob' => $this->dob,
            'doj' => $this->doj,
            'designation' => $this->designation,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'address' => $this->address,
            'street' => $this->street,
            'city' => $this->city,
            'region' => $this->region,
            'state' => $this->state,
            'country' => $this->country,
            'photo' => $this->photo,
            'web' => $this->web,
            'social_urls' => $this->social_urls,
            'status' => $this->status,
            'email_verified_at' => $this->email_verified_at,
            'user_id' => $this->user_id,
            'user_type' => $this->user_type,
            'upload_folder' => $this->upload_folder,
            'created_at' => !is_null($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at' => !is_null($this->updated_at) ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'meta' => [
                'exists' => $this->exists(),
                'link' => $this->itemLink(),
                'upload_url' => $this->getUploadURL(''),
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param   \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'meta' => [
                'exists' => $this->exists(),
                'link' => $this->itemLink(),
                'upload_url' => $this->getUploadURL(''),
                'workflow' => $this->workflows(),
                'actions' => $this->actions(),
            ],
        ];
    }

    private function workflows()
    {
        $arr = [];
                return $arr;

    }
    private function actions()
    {

        $arr = [];
        
        return $arr;
    }
}
