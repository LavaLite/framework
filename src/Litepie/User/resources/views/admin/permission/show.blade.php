
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#permission" data-toggle="tab">  {!! trans('user::permission.name') !!}</a></li>        
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#user-permission-entry' data-href='{{trans_url('admin/user/permission/create')}}'><i class="fa fa-plus-circle"></i> New</button>
            @if($permission->id )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#user-permission-entry' data-href='{{ trans_url('/admin/user/permission') }}/{{$permission->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#user-permission-entry' data-datatable='#user-permission-list' data-href='{{ trans_url('/admin/user/permission') }}/{{$permission->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> Delete
            </button>
            @endif
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('user-permission-show')
    ->method('POST')
    ->files('true')
    ->action(trans_url('admin/user/permission'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="permission">
                <div class="tab-pan-title">  {!! trans('app.view') !!}  {!! trans('user::permission.name') !!} [ {!!$permission->name!!} ] </div>
                @include('vuser::admin.permission.partial.entry')
            </div>
        </div>
    {!! Form::close() !!}
</div>