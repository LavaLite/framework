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
            'experience' => $this->experience,
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
            'photo_gallery' => $this->getPhotos(),
            'web' => $this->web,
            'social_urls' => $this->social_urls,
            'status' => $this->status,
            'email_verified_at' => $this->email_verified_at,
            'user_id' => $this->user_id,
            'user_type' => $this->user_type,
            'upload_folder' => $this->upload_folder,
            'languages' => $this->languages,
            'rera' => $this->rera,
            'education' => $this->education,
            'opportunity' => $this->opportunity,
            'location' => $this->getLocation(),
            'roles' => $this->getRoles(),
            'history' => $this->getActivities(2),
            'created_at' => !is_null($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at' => !is_null($this->updated_at) ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'meta' => [
                'exists' => $this->exists(),
                'link' => $this->itemLink(),
                'upload_url' => $this->getUploadURL(''),
            ],
            '_settings' => $this->getSettings()
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
        $actions = $this->resource->actions()->details();
        foreach ($actions as $key => $action) {
            $name = $action->name();
            $meta = $action->meta();
            $arr[$key]['url'] = guard_url('user/action' . $this->getRouteKey() . '/' . $action->name());
            $arr[$key]['name'] = $name;
            $arr[$key]['key'] = $name;
            $arr[$key]['form'] = $action->form();
            $arr[$key]['label'] = trans('user::user.actions.' . $name);
            if (!empty($meta)) {
                $arr[$key]['meta']['method'] = @$meta['method'];
                $arr[$key]['meta']['url'] = url('user/' . $this->getRouteKey() . @$meta['url']);
                $arr[$key]['meta']['element'] = @$meta['element'];
                $arr[$key]['meta']['parent'] = @$meta['parent'];
            }
        }

        return $arr;
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
    public function getPhotos()
    {
        $photos = $this->photo;
        if ($photos === null) {
            $photos = [];
        }
        return $photos;
    }
    public function getRoles()
    {
        if ($this->roles) {
            $roleIds = $this->roles->pluck('id')->map(function ($roleId) {
                return  $roleId;
            })->toArray();

            return $roleIds;
        }

        return '';
    }
}
