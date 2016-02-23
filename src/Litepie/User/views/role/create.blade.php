<div class="box-header with-border">
    <h3 class="box-title"> {{ trans('cms.new') }}  {!! trans('user.role.name') !!} </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#user-role-create'  data-load-to='#user-role-entry' data-datatable='#user-role-list'><i class="fa fa-floppy-o"></i> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#user-role-entry' data-href='{{Trans::to('admin/user/role/0')}}'><i class="fa fa-times-circle"></i> cms.close</button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Role</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('user-role-create')
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