    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#permission" data-toggle="tab">{!! trans('roles::permission.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#roles-permission-edit'  data-load-to='#roles-permission-entry' data-datatable='#roles-permission-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#roles-permission-entry' data-href='{{guard_url('roles/permission')}}/{{$permission->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('roles-permission-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(guard_url('roles/permission/'. $permission->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="permission">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('roles::permission.name') !!} [{!!$permission->name!!}] </div>
                @include('roles::admin.permission.partial.entry', ['mode' => 'edit'])
            </div>
        </div>
        {!!Form::close()!!}
    </div>