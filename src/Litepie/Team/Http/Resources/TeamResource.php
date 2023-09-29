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
            'users' => $this->getUsers(),
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
    private function getUsers()
    {
        $results = $this->users()->get();

        foreach ($results as $key => $result) {
            $results[$key]['level_name'] = trans('team::team.options.level.' . $result['pivot']['level'] . '.name');
        }
        return $results;
    }
}
