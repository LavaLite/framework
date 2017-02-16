    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">  {!! trans('alert::notification.name') !!}</a></li>
            <div class="box-tools pull-right">
                
                @if($notification->id )
                <button type="button" class="btn btn-danger btn-sm" data-alert="DELETE" data-load-to='#alert-notification-entry' data-datatable='#alert-notification-list' data-href='{{ trans_url('/admin/alert/notification') }}/{{$notification->getRouteKey()}}' >
                <i class="fa fa-times-circle"></i> {{ trans('app.delete') }}
                </button>
                @endif
            </div>
        </ul>
        {!!Form::vertical_open()
        ->id('alert-notification-show')
        ->method('POST')
        ->files('true')
        ->alert(trans_url('admin/alert/notification'))!!}
            <div class="tab-content clearfix">
                <div class="tab-pan-title"> {{ trans('app.view') }}   {!! trans('alert::notification.name') !!}  [{!! $notification->data['name'] !!}] </div>
                <div class="tab-pane active" id="details">
                    @include('alert::admin.notification.partial.entry')
                </div>
            </div>
        {!! Form::close() !!}
    </div>