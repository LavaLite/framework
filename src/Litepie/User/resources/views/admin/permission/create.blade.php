
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#permission" data-toggle="tab">Contact</a></li>
            <li><a href="#details" data-toggle="tab">Details</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#user-permission-create'  data-load-to='#user-permission-entry' data-datatable='#user-permission-list'><i class="fa fa-floppy-o"></i> Save</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#user-permission-entry' data-href='{{trans_url('admin/user/permission/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('user-permission-create')
        ->method('POST')
        ->files('true')
        ->action(trans_url('admin/user/permission'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="permission">
                <div class="tab-pan-title">  {!! trans('app.create') !!}  {!! trans('user::permission.name') !!} </div>
                @include('vuser::admin.permission.partial.entry')
            </div>
        </div>
        {!! Form::close() !!}
    </div>