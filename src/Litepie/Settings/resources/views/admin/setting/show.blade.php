<div class="nav-tabs-custom">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs primary">
        <li class="active"><a href="#details" data-toggle="tab">  {!! trans('settings::setting.name') !!}</a></li>
        <div class="box-tools pull-right">
            @include('settings::admin.setting.partial.workflow')
            <button type="button" class="btn btn-success btn-sm" data-action='NEW' data-load-to='#settings-setting-entry' data-href='{{trans_url('admin/settings/setting/create')}}'><i class="fa fa-times-circle"></i> {{ trans('app.new') }}</button>
            @if($setting->id )
            <button type="button" class="btn btn-primary btn-sm" data-action="EDIT" data-load-to='#settings-setting-entry' data-href='{{ trans_url('/admin/settings/setting') }}/{{$setting->getRouteKey()}}/edit'><i class="fa fa-pencil-square"></i> {{ trans('app.edit') }}</button>
            <button type="button" class="btn btn-danger btn-sm" data-action="DELETE" data-load-to='#settings-setting-entry' data-datatable='#settings-setting-list' data-href='{{ trans_url('/admin/settings/setting') }}/{{$setting->getRouteKey()}}' >
            <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
            </button>
            @endif
        </div>
    </ul>
    {!!Form::vertical_open()
    ->id('settings-setting-show')
    ->method('POST')
    ->files('true')
    ->action(URL::to('admin/settings/setting'))!!}
        <div class="tab-content clearfix">
            <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('settings::setting.name') !!}  [{!! $setting->name !!}] </div>
            <div class="tab-pane active disabled" id="details">
                @include('settings::admin.setting.partial.entry')
                
            </div>
        </div>
    {!! Form::close() !!}
</div>