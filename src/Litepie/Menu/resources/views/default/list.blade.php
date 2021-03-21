@foreach($rootMenu as $menu)
<div class="app-item {{$menu->getRouteKey()}} app-item-flex">
    <div class="app-avatar">
        <input type="checkbox" name="tasks_list" id="task_{{$menu->getRouteKey()}}">
        <label class="app-project-name bg-warning" for="task_{{$menu->getRouteKey()}}">{{$menu['name'][0]}}</label>
    </div>
    <div class="app-info" data-action='SHOW' data-load-to="#app-entry"
        data-url="{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}">
        <h3>{{$menu['name']}}</h3>
        <div class="app-metas">
            <p>Manage {{$menu['key']}} menu</p>
            <span class="badge badge-status in-progress">{!! trans('menu::menu.options.status')[$menu['status']]
                !!}</span>
        </div>
    </div>
    <div class="app-actions">
        <a href="{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}" class="btn las la-pencil-alt" data-action='EDIT'
            data-load-to="#app-entry" data-url="{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}/edit">
        </a>
        <a href="{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}" class="btn las la-times text-danger"
            data-action='DELETE' data-load-to="#app-entry" data-list="#item-list"
            data-url="{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}">
        </a>
    </div>
</div>
@endforeach