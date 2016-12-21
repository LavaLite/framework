<div class="box-header with-border">
    <h3 class="box-title"> Edit  {!! trans('message::message.name') !!} [{!!$message->name!!}] </h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" data-action='UPDATE' data-form='#message-message-edit'  data-load-to='#message-message-entry' data-datatable='#message-message-list'><i class="fa fa-floppy-o"></i> Save</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#message-message-entry' data-href='{{trans_url('admin/message/message')}}/{{$message->getRouteKey()}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#message" data-toggle="tab">{!! trans('message::message.tab.name') !!}</a></li>
        </ul>
        {!!Form::vertical_open()
        ->id('message-message-edit')
        ->method('PUT')
        ->enctype('multipart/form-data')
        ->action(trans_url('admin/message/message/'. $message->getRouteKey()))!!}
        <div class="tab-content">
            <div class="tab-pane active" id="message">
                @include('message::admin.message.partial.entry')
            </div>
        </div>
        {!!Form::close()!!}
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>