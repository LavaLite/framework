<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">  {!! trans('settings::setting.names') !!} [{!! trans('settings::setting.text.preview') !!}]</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm"  data-action='NEW' data-load-to='#settings-setting-entry' data-href='{!!trans_url('admin/settings/setting/create')!!}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }} </button>
        </div>
    </div>
</div>