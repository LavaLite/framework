
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
        <div class="dropdown">
            <a href="#" class="btn fas fa-ellipsis-h dropdown-toggle" href="#" role="button"
                id="app_quick_menu_{{$menu->getRouteKey()}}" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="app_quick_menu_{{$menu->getRouteKey()}}">
                <!-- <a class="dropdown-item" href="#"><i class="las la-copy"></i>Copy</a> -->
                <a class="dropdown-item" href="{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}" data-action='DELETE'
                data-load-to="#app-entry" data-list="#item-list"
                data-url="{{guard_url('menu/menu')}}/{{$menu->getRouteKey()}}"><i class="las la-times text-danger"></i>Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach