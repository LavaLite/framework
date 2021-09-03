<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">  {!! trans('alerts::notification.names') !!} [{!! trans('alerts::notification.text.preview') !!}]</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm"  data-alerts='NEW' data-load-to='#alerts-notification-entry' data-href='{!!trans_url('admin/alerts/notification/create')!!}'><i class="fa fa-plus-circle"></i> {{ trans('app.new') }} </button>
        </div>
    </div>
</div>