    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Setting</a></li>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#settings-setting-create'  data-load-to='#settings-setting-entry' data-datatable='#settings-setting-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                <button type="button" class="btn btn-default btn-sm" data-action='CLOSE' data-load-to='#settings-setting-entry' data-href='{{trans_url('admin/settings/setting/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.close') }}</button>
            </div>
        </ul>
        <div class="tab-content clearfix">
            {!!Form::vertical_open()
            ->id('settings-setting-create')
            ->method('POST')
            ->files('true')
            ->action(trans_url('admin/settings/setting'))!!}
            <div class="tab-pane active" id="details">
                <div class="tab-pan-title">  {{ trans('app.new') }}  [{!! trans('settings::setting.name') !!}] </div>
                @include('settings::admin.setting.partial.entry')
            </div>
            {!! Form::close() !!}
        </div>
    </div>