<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('cms.view') }}   {!! trans('user.role.name') !!}  [{!! $role->name !!}]  </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#user-role-entry' data-href='{{ trans_url('admin/user/role/create') }}'><i class="fa fa-times-circle"></i> New</button>
        @if($role->id )
        <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#user-role-entry' data-href='{{ trans_url('/admin/user/role') }}/{{$role->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> Edit</button>
        <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#user-role-entry' data-datatable='#user-role-list' data-href='{{ trans_url('/admin/user/role') }}/{{$role->getRouteKey()}}' >
        <i class="fa fa-times-circle"></i> Delete
        </button>
        @endif
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('user.role.name') !!}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('user-role-show')
        ->method('POST')
        ->files('true')
        ->action(URL::to('admin/user/role'))!!}
            <div class="tab-content">
                <div class="tab-pane active" id="details">
                    @include('User::role.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>