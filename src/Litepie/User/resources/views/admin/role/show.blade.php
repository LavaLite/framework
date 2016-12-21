
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#role" data-toggle="tab">  {!! trans('user::role.name') !!}</a></li>        
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#user-role-entry' data-href='{{trans_url('admin/user/role/create')}}'><i class="fa fa-plus-circle"></i> New</button>
            @if($role->id )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#user-role-entry' data-href='{{ trans_url('/admin/user/role') }}/{{$role->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#user-role-entry' data-datatable='#user-role-list' data-href='{{ trans_url('/admin/user/role') }}/{{$role->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> Delete
            </button>
            @endif
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('user-role-show')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/user/role'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active disabled" id="role">
                <div class="tab-pan-title">  {!! trans('app.view') !!}  {!! trans('user::role.name') !!} [ {!!$role->name!!} ] </div>
                @include('vuser::admin.role.partial.entry')
            </div>
        </div>
    {!! Form::close() !!}
</div>