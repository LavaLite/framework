    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('master::master.name') !!}</a></li>
            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#master-master-entry' data-href='{{guard_url('master/master/create')}}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }}</button>
                @if($master->id )
                <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#master-master-entry' data-href='{{ guard_url('master/master') }}/{{$master->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
                <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#master-master-entry' data-datatable='#master-master-list' data-href='{{ guard_url('master/master') }}/{{$master->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('master-master-show')
        ->method('POST')
        ->files('true')
        ->action(guard_url('master/master'))!!}
            <div class="tab-content clearfix disabled">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('master::master.name') !!}  [{!! $master->name !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('master::admin.master.partial.entry', ['mode' => 'show', 'type' => $master->type])
                </div>
            </div>
        {!! Form::close() !!}
    </div>