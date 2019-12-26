    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#master" data-toggle="tab">{!! trans('master::master.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#master-master-edit'  data-load-to='#masters-entry' data-datatable='#masters-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#masters-entry' data-href='{{guard_url("masters/{$group}/{$type}/master")}}/{{$master->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('master-master-edit')
        ->method('POST')
        ->enctype('multipart/form-data')
        ->action(guard_url("masters/{$group}/{$type}/master"))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="master">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('master::master.name') !!} [{!!$master->name!!}] </div>
                @include('master::'. config("master.masters.$type.view", 'master.default'), ['mode' => 'create', 'type'
                => $type])
            </div>
        </div>
        {!!Form::close()!!}
    </div>