<div class="box-header with-border">
    <h3 class="box-title">  {!! trans('message::message.names') !!}</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm"  data-action='NEW' data-load-to='#message-message-entry' data-href='{!!guard_url('message/message/create')!!}'><i class="fa fa-plus-circle"></i> New </button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" style="min-height:100px">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <h1 class="text-center">
            <small>
            <button type="button" class="btn btn-app" data-toggle="tooltip" data-placement="top" title="" data-action='NEW' data-load-to='#message-message-entry' data-href='{!!guard_url('message/message/create')!!}'>
            <span class="badge bg-purple">{!! Message::countOf('message') !!}</span>
            <i class="fa fa-plus-circle  fa-3x"></i>
            {{ trans('app.create') }} {!! trans('message::message.name') !!}
            </button>
            <br>{!! trans('message::message.text.preview') !!}
            </small>
            </h1>
        </div>
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>