<?php

namespace Litepie\Menu\Actions;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Menu\Models\Menu;
use Litepie\Notification\Traits\SendNotification;

class MenuAction
{
    use AsAction;
    use LogsActions;
    use SendNotification;

    private $model;

    public function handle(string $action, Menu $menu, array $request = [])
    {
        $this->model = $menu;

        $function = Str::camel($action);
        event('menu.menu.action.' . $action . 'ing', [$menu]);
        $data = $this->$function($menu, $request);
        event('menu.menu.action.' . $action . 'ed', [$menu]);

        $this->logsAction();
        $this->notify();
        return $data;
    }

    public function store(Menu $menu, array $request)
    {
        $attributes = $request;
        $attributes['user_id'] = user_id();
        $attributes['user_type'] = user_type();
        $menu = $menu->create($attributes);
        return $menu;
    }

    public function update(Menu $menu, array $request)
    {
        $attributes = $request;
        $menu->update($attributes);
        return $menu;
    }

    public function destroy(Menu $menu, array $request)
    {
        $cid = $menu->id;

        if (Menu::where('parent_id', $cid)->count() > 0) {
            return response()->json([
                'message' => 'Child menu exists.',
                'type'    => 'warning',
                'title'   => 'Warning',
            ], 409);
        }

        $menu->delete();
        return $menu;
    }

    public function copy(Menu $menu, array $request)
    {
        $count = $request['count'] ?: 1;

        if ($count == 1) {
            $menu = $menu->replicate();
            $menu->created_at = Carbon::now();
            $menu->save();
            return $menu;
        }

        for ($i = 1; $i <= $count; $i++) {
            $new = $menu->replicate();
            $new->created_at = Carbon::now();
            $new->save();
        }

        return $menu;
    }

    public function updateTree($model, $request)
    {
        $tree = json_decode($request['tree'], true);
        $parent_id = hashids_decode($request['parent_id']);
        $model->tempHolder = [];
        $model->getParentChild($model->id, $tree);
        foreach ($model->tempHolder as $parent => $children) {
            foreach ($children as $key => $val) {
                Menu::findOrFail($val)
                    ->update([
                        'parent_id' => $parent ?: $parent_id,
                        'order' => $key,
                    ]);
            }
        }
    }
}
