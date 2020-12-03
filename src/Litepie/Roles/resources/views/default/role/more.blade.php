@foreach($data as $key => $value)
<div class="app-item app-item-flex align-items-center">
    <div class="app-avatar">
        <input type="checkbox" name="tasks_list" id="task_{{$value['id']}}">
        <label class="app-project-name bg-secondary" for="task_{{$value['id']}}">{{$value['name'][0]}}</label>
    </div>
    <div class="app-info" data-action='SHOW' data-load-to="#app-entry"
        data-url="{{guard_url('roles/role')}}/{{$value['id']}}">
        <h3>{{$value['name']}}</h3>
        <div class="app-metas">
            <p>{{@$value[' description']}}</p>
            <span class="badge badge-status in-progress"></span>
        </div>
    </div>
    <div class="app-actions app-action-center">
        <a href="{{guard_url('roles/role')}}/{{$value['id']}}" class="btn las la-pencil-alt" data-action='EDIT'
            data-load-to="#app-entry" data-url="{{guard_url('roles/role')}}/{{$value['id']}}/edit">
        </a>
        <div class="dropdown">
            <a href="#" class="btn las la-ellipsis-h dropdown-toggle" href="#" role="button"
                id="app_quick_menu_{{$value['id']}}" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="app_quick_menu_{{$value['id']}}">
                <a class="dropdown-item" href="#"><i class="las la-copy"></i>Copy</a>
                <a class="dropdown-item" href="{{guard_url('roles/role')}}/{!!$value['id']!!}" data-action='DELETE'
                data-load-to="#app-entry" data-list="#item-list"
                data-url="{{guard_url('roles/role')}}/{!!$value['id']!!}"><i class="las la-times text-danger"></i>Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach