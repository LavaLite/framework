@foreach($data as $key => $value)
<div class="app-item">
    <div class="app-avatar">
        <div class="app-avatar-image bg-primary">{!!@$value['title'][0]!!}</div>
        <div class="app-avatar-checkbox">
            <input type="checkbox" name="item_list[]" id="item_{!!$value['id']!!}" value="{!!$value['id']!!}">
            <label for="item_{!!$value['id']!!}"></label>
        </div>
    </div>
    <div class="app-info" data-action='SHOW' data-load-to="#app-entry"
        data-url="{!!guard_url('team/team')!!}/{!!$value['id']!!}">
        <h3>{!!@$value['title']!!}</h3>
        <div class="app-metas">
            <p>{!!@$value['details']!!}</p>
            <span class="badge badge-status in-progress">{!!@$value['status']!!}</span>
        </div>
    </div>
    <div class="app-actions">
        <a href="{!!guard_url('team/team')!!}/{!!$value['id']!!}" class="btn fas fa-pencil-alt" data-action='EDIT'
            data-load-to="#app-entry" data-url="{!!guard_url('team/team')!!}/{!!$value['id']!!}/edit"></a>
        <div class="dropdown">
            <a href="#" class="btn fas fa-ellipsis-h dropdown-toggle" role="button" id="dropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#appDetailModal" data-toggle="modal" data-target="#appDetailModal"><i
                        class="las la-eye"></i>View</a>
                <a class="dropdown-item" href="#"><i class="las la-copy"></i>Copy</a>
                <a class="dropdown-item" href="#"><i class="las la-inbox"></i>Archive</a>
                <a class="dropdown-item" href="{!!guard_url('team/team')!!}/{!!$value['id']!!}" 
                                        data-action='DELETE' data-load-to="#app-entry" data-list="#item-list"
                                        data-url="{!!guard_url('team/team')!!}/{!!$value['id']!!}"><i class="las la-times text-danger"></i>Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach