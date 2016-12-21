
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#role" data-toggle="tab">{!! trans('user::role.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#user-role-edit'  data-load-to='#user-role-entry' data-datatable='#user-role-list'><i class="fa fa-floppy-o"></i> Save</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#user-role-entry' data-href='{{trans_url('admin/user/role')}}/{{$role->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('user-role-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/user/role/'. $role->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="role">
                <div class="tab-pan-title">  {!! trans('app.edit') !!}  {!! trans('user::role.name') !!} [ {!!$role->name!!} ] </div>
                @include('vuser::admin.role.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>