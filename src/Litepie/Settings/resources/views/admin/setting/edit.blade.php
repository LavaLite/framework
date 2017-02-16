    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#setting" data-toggle="tab">{!! trans('settings::setting.tab.name') !!}</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#settings-setting-edit'  data-load-to='#settings-setting-entry' data-datatable='#settings-setting-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#settings-setting-entry' data-href='{{trans_url('admin/settings/setting')}}/{{$setting->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>

            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('settings-setting-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/settings/setting/'. $setting->getRouteKey()))!!}
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="setting">
                <div class="tab-pan-title">  {{ trans('app.edit') }}  {!! trans('settings::setting.name') !!} [{!!$setting->name!!}] </div>
                @include('settings::admin.setting.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>