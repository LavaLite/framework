    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#role" data-toggle="tab">{!! trans('roles::role.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#roles-role-edit'  data-load-to='#roles-role-entry' data-datatable='#roles-role-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#roles-role-entry' data-href='{{guard_url('roles/role')}}/{{$role->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('roles-role-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(guard_url('roles/role/'. $role->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="role">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('roles::role.name') !!} [{!!$role->name!!}] </div>
                @include('roles::admin.role.partial.entry', ['mode' => 'edit'])
            </div>
        </div>
        {!!Form::close()!!}
    </div>