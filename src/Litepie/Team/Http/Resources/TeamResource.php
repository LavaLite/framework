<?php

namespace Litepie\Team\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{

    public function itemLink()
    {
        return guard_url('team/team') . '/' . $this->getRouteKey();
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
            'name' => $this->name,
            'key' => $this->key,
            'level' => $this->level,
            'type' => $this->type,
            'status' => $this->status,
            'description' => $this->description,
            'settings' => $this->settings,
            'created_at' => !is_null($this->created_at) ? $this->created_at->format('Y-m-d H:i:s') : null,
            'updated_at' => !is_null($this->updated_at) ? $this->updated_at->format('Y-m-d H:i:s') : null,
            'meta' => [
                'exists' => $this->exists(),
                'link' => $this->itemLink(),
                'upload_url' => $this->getUploadURL(''),
            ],
            '_settings' => $this->getSettings(),
            'team_users' => $this->teamUsers('Active'),
            'preview_title' => 'Team',
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
    private function teamUsers($status = 'Active')
    {
        $results = $this->users()->where('team_user.status', $status)->get();
        foreach ($results as $result) {
            $result['id_org'] = hashids_encode(@$result['id']);
            $result['p_level'] = @$result['pivot']['level'];
            $result['p_level_name'] = $this->get_pname(@$result['pivot']['level']);
            $result['p_user_id'] = @$result['pivot']['user_id'];
            $result['p_status'] = @$result['pivot']['status'];
            $result['p_created_at'] = @$result['pivot']['created_at'];
            $result['p_updated_at'] = @$result['pivot']['updated_at'];
        }
        return $results;
    }
    private function get_pname($key)
    {
        $name = null;
        $options = trans('team::team.options.level');
        foreach ($options as $item) {
            if ($item['key'] == $key) {
                $name = $item['name'];
                break;
            }
        }
        return $name;
    }
}
