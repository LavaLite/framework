    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('roles::permission.name') !!}</a></li>
            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#roles-permission-entry' data-href='{{guard_url('roles/permission/create')}}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }}</button>
                @if($permission->id )
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#roles-permission-entry' data-href='{{ guard_url('roles/permission') }}/{{$permission->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#roles-permission-entry' data-datatable='#roles-permission-list' data-href='{{ guard_url('roles/permission') }}/{{$permission->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('roles-permission-show')
        ->method('POST')
        ->files('true')
        ->action(guard_url('roles/permission'))!!}
            <div class="tab-content clearfix disabled">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('roles::permission.name') !!}  [{!! $permission->name !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('roles::admin.permission.partial.entry', ['mode' => 'show'])
                </div>
            </div>
        {!! Form::close() !!}
    </div>