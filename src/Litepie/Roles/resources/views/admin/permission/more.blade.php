@foreach($data as $key => $value)
<div class="app-item">
    <div class="app-info" data-action='SHOW' data-load-to="#app-entry"
        data-url="{{guard_url('roles/permission')}}/{{$value['id']}}">
        <input type="checkbox" name="tasks_list" id="task_{{$value['id']}}">
        <label class="app-project-name bg-secondary" for="task_{{$value['id']}}">{{$value['name'][0]}}</label>
        <h3>{{$value['name']}}</h3>
        <div class="app-metas">
            <p>{{@$value['description']}}</p>
            <span class="badge badge-status in-progress"></span>
        </div>
    </div>
    <div class="app-actions">
        <a href="{{guard_url('roles/permission')}}/{{$value['id']}}" class="btn las la-pencil-alt" data-action='EDIT'
            data-load-to="#app-entry" data-url="{{guard_url('roles/permission')}}/{{$value['id']}}/edit">
        </a>
        <div class="dropdown">
            <a href="#" class="btn las la-ellipsis-h dropdown-toggle" href="#" role="button"
                id="app_quick_menu_{{$value['id']}}" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="app_quick_menu_{{$value['id']}}">
                <a class="dropdown-item" href="#appDetailModal" data-toggle="modal" data-target="#appDetailModal"><i
                        class="las la-eye"></i>View</a>
                <a class="dropdown-item" href="#"><i class="las la-copy"></i>Copy</a>
                <a class="dropdown-item" href="#"><i class="las la-inbox"></i>Archive</a>
                <a class="dropdown-item" href="{{guard_url('roles/permission')}}/{!!$value['id']!!}" data-action='DELETE'
                data-load-to="#app-entry" data-list="#item-list"
                data-url="{{guard_url('roles/permission')}}/{!!$value['id']!!}"><i class="las la-times text-danger"></i>Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach