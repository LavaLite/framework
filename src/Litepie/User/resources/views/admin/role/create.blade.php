
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#role" data-toggle="tab">Contact</a></li>
            <li><a href="#details" data-toggle="tab">Details</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#user-role-create'  data-load-to='#user-role-entry' data-datatable='#user-role-list'><i class="fa fa-floppy-o"></i> Save</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#user-role-entry' data-href='{{trans_url('admin/user/role/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('user-role-create')
        ->method('POST')
        ->files('true')
        ->action(trans_url('admin/user/role'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="role">
                <div class="tab-pan-title">  {!! trans('app.create') !!}  {!! trans('user::role.name') !!} </div>
                @include('vuser::admin.role.partial.entry')
            </div>
        </div>
        {!! Form::close() !!}
    </div>