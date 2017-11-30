    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('roles::role.name') !!}</a></li>
            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#roles-role-entry' data-href='{{guard_url('roles/role/create')}}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }}</button>
                @if($role->id )
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#roles-role-entry' data-href='{{ guard_url('roles/role') }}/{{$role->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#roles-role-entry' data-datatable='#roles-role-list' data-href='{{ guard_url('roles/role') }}/{{$role->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('roles-role-show')
        ->method('POST')
        ->files('true')
        ->action(guard_url('roles/role'))!!}
            <div class="tab-content clearfix disabled">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('roles::role.name') !!}  [{!! $role->name !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('roles::admin.role.partial.entry', ['mode' => 'show'])
                </div>
            </div>
        {!! Form::close() !!}
    </div>