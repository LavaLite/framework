<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('cms.view') }}   {{ trans('user.permission.name') }}  [{{ $permission->name }}]  </h3>
    <div class="box-tools pull-right">
       <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#entry-permission' data-href='{{Trans::to('admin/user/permission/create')}}'><i class="fa fa-times-circle"></i> {{ trans('cms.new') }}</button>
        @if($permission->id)
        <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#entry-permission' data-href='{{ trans_url('/admin/user/permission') }}/{{$permission->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('cms.edit') }}</button>
        <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#entry-permission' data-datatable='#main-list' data-href='{{ trans_url('/admin/user/permission') }}/{{$permission->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> {{ trans('cms.delete') }}
        </button>
        @endif
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab"> {{ trans('user.permission.tab.name') }}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('user-permission-show')
        ->method('PUT')
        ->action(trans_url('admin/user/permission/'. $permission->getRouteKey()))!!}
        {!!Form::token()!!}
            <div class="tab-content">
                <div class="tab-pane active" id="details">
                    @include('User::permission.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>