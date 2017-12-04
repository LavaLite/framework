<div class="box-header with-border">
    <h3 class="box-title">  {!! trans('calendar::calendar.names') !!}</h3>
    <div class="box-tools pull-right">
        <button type="button" class="btn btn-primary btn-sm" id="btn-new-calendar"><i class="fa fa-plus-circle"></i> New </button>
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" style="min-height:100px">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <h1 class="text-center">
            <small>
            <button type="button" class="btn btn-app" data-toggle="tooltip" data-placement="top" title=""  id="btn-new-calendar-icn">
            <span class="badge bg-purple">{!! Calendar::count('calendar') !!}</span>
            <i class="fa fa-plus-circle  fa-3x"></i>
            {{ trans('app.create') }} {!! trans('calendar::calendar.name') !!}
            </button>
            <br>{!! trans('calendar::calendar.text.preview') !!}
            </small>
            </h1>
        </div>
    </div>
</div>
<div class="box-footer" >
    &nbsp;
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#btn-new-calendar, #btn-new-calendar-icn').click(function(){
        $('#entry-calendar').load('{!!guard_url('calendar/calendar/create')!!}');
    });
});
</script>