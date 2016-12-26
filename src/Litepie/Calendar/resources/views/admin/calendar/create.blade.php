<!-- <div class="box-header with-border">
    <h3 class="box-title"> New Calendar </h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-primary btn-sm" data-action='CREATE' data-form='#create-calendar-calendar'  data-load-to='#entry-calendar' data-datatable='#main-list'><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
        <button type="button" class="btn btn-default btn-sm" data-action='CANCEL' data-load-to='#entry-calendar' data-href='{{Trans::to('admin/calendar/calendar/0')}}'><i class="fa fa-times-circle"></i> {{ trans('app.cancel') }}</button>
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<div class="box-body" >
    <div class="nav-tabs-custom">
        Nav tabs
        <ul class="nav nav-tabs primary">
            <li class="active"><a href="#details" data-toggle="tab">Calendar</a></li>
        </ul> -->
    <div class="row"> 
        {!!Form::vertical_open()
        ->id('create-calendar-calendar')
        ->method('POST')
        ->files('true')
        ->action(URL::to('admin/calendar/calendar'))!!}
        <div class="tab-content">
            <div class="tab-pane active" id="details">
                @include('calendar::admin.calendar.partial.entry')
                  <div class='col-md-12 col-sm-12 '>                  
                <button type="button" class="btn  btn-default btn-xs pull-right" style="margin-left: 5px" data-dismiss="modal"><i class="fa fa-times-circle-o"></i> Close</button>    
                  
                  <button class="btn btn-primary btn-xs pull-right" type="submit"><i class="fa fa-floppy-o"></i>Save</button>
                  </div>
            </div>
        </div>
    {!! Form::close() !!}
    </div>
<!-- </div>
<div class="box-footer" >
    &nbsp;
</div> -->