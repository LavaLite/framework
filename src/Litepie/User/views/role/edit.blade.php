<div class="box-header with-border">
    <h3 class="box-title"> Edit  {!! trans('user.role.name') !!} [{!!$role->name!!}] </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#user-role-edit'  data-load-to='#user-role-entry' data-datatable='#user-role-list'><i class="fa fa-floppy-o"></i> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#user-role-entry' data-href='{{Trans::to('admin/user/role')}}/{{$role->getRouteKey()}}'><i class="fa fa-times-circle"></i> cms.cancel</button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#role" data-toggle="tab">{!! trans('user.role.tab.name') !!}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('user-role-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(URL::to('admin/user/role/'. $role->getRouteKey()))!!}
        <div class="tab-content">
            <div class="tab-pane active" id="role">
                @include('User::role.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>