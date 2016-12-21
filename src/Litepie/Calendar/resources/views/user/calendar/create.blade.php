
<div class="box-body row" >
    <div class="nav-tabs-custom">
        <!-- Nav tabs -->
 
        {!!Form::vertical_open()
        ->id('create-calendar-calendar')
        ->method('POST')
        ->files('true')
        ->action(URL::to($guard.'/calendar/calendar'))!!}
        <div class="tab-content">
            <div class="tab-pane active" id="details">
                @include('calendar::user.calendar.partial.entry')
                <div class="col-md-12 mt20">
                     <button type="button" class="btn btn-sm mr5 btn-danger btn-raised pull-right " data-dismiss="modal"><i class="fa fa-times-circle-o"></i> {{ trans('app.cancel') }}</button>
                     <button type="submit" class="btn btn-sm mr5 btn-success btn-raised pull-right" data-dismis="modal"><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
                </div>
            </div>
        </div>
   
    {!! Form::close() !!}
    </div>
</div>
