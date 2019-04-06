    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#master" data-toggle="tab">{!! trans('master::master.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#master-master-edit'  data-load-to='#master-master-entry' data-datatable='#master-master-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#master-master-entry' data-href='{{guard_url('master/master')}}/{{$master->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('master-master-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(guard_url('masters/'. $master->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="master">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('master::master.name') !!} [{!!$master->name!!}] </div>
                @include('master::admin.master.type.'.$slug, ['mode' => 'edit', 'type'=>$master->type])
            </div>
        </div>
        {!!Form::close()!!}
    </div>