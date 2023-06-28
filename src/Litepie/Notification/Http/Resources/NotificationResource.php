<?php

namespace Litepie\Notification\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{

    public function itemLink()
    {
        return guard_url('notification/notification') . '/' . $this->getRouteKey();
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
            'type' => $this->type,
            'type_sub' => $this->type_sub,
            'notifiable_id' => $this->notifiable_id,
            'notifiable_type' => $this->notifiable_type,
            'data' => $this->data,
            'message' => $this->message,
            'actions' => $this->actions,
            'variant' => $this->variant,
            'pinned' => $this->pinned,
            'read_at' => $this->read_at,
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
