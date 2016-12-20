
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#permission" data-toggle="tab">{!! trans('user::permission.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#user-permission-edit'  data-load-to='#user-permission-entry' data-datatable='#user-permission-list'><i class="fa fa-floppy-o"></i> Save</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#user-permission-entry' data-href='{{trans_url('admin/user/permission')}}/{{$permission->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('user-permission-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/user/permission/'. $permission->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="permission">
                <div class="tab-pan-title">  {!! trans('app.edit') !!}  {!! trans('user::permission.name') !!} [ {!!$permission->name!!} ] </div>
                @include('vuser::admin.permission.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>