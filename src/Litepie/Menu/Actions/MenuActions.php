<?php

namespace Litepie\Menu\Actions;

use Illuminate\Support\Str;
use Litepie\Menu\Models\Menu;
use Litepie\Menu\Scopes\MenuResourceScope;
use Litepie\Actions\Concerns\AsAction;
use Litepie\Actions\Traits\LogsActions;
use Litepie\Database\RequestScope;

class MenuActions
{
    use AsAction;
    use LogsActions;
    
    private $model;

    public function handle(string $action, array $request)
    {
        $this->model = app(Menu::class);

        $function = Str::camel($action);

        event('menu.menu.action.' . $action . 'ing', [$request]);
        $data = $this->$function($request);
        event('menu.menu.action.' . $action . 'ed', [$data]);

        $this->logsAction();
        return $data;

    }

    public function paginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $menu = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new MenuResourceScope())
            ->paginate($pageLimit);

        return $menu;
    }

    public function simplePaginate(array $request)
    {
        $pageLimit = isset($request['pageLimit']) ?: config('database.pagination.limit');
        $menu = $this->model
            ->pushScope(new RequestScope())
            ->pushScope(new MenuResourceScope())
            ->simplePaginate($pageLimit);

        return $menu;
    }

    function empty(array $request) {
        return $this->model->forceDelete();
    }

    function restore(array $request) {
        return $this->model->restore();
    }

    public function delete(array $request)
    {
        $ids = $request['ids'];
        $ids = collect($ids)->map(function ($id) {
            return hashids_decode($id);
        });
        return $this->model->whereIn('id', $ids)->delete();
    }
}
