    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('alerts::notification.name') !!}</a></li>
            <div class="box-tools pull-right">
                
                @if($notification->id )
                <button type="button" class="btn btn-danger btn-sm" data-alerts="DELETE" data-load-to='#alerts-notification-entry' data-datatable='#alerts-notification-list' data-href='{{ trans_url('/admin/alerts/notification') }}/{{$notification->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('alerts-notification-show')
        ->method('POST')
        ->files('true')
        ->alerts(trans_url('admin/alerts/notification'))!!}
            <div class="tab-content clearfix">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('alerts::notification.name') !!}  [{!! $notification->data['name'] !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('alerts::admin.notification.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>