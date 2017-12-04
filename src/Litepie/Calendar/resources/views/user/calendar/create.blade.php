    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{__('app.new')}} {{__('calendar::calendar.name')}}</h4>
        </div>
        {!!Form::vertical_open()
        ->id('create-calendar-calendar')
        ->method('POST')
        ->files('true')
        ->action(guard_url('calendar/calendar'))!!}
        <div class="modal-body">
            @include('calendar::user.calendar.partial.entry')
        </div>
        <div class="modal-footer"> 
             <button type="button" class="btn btn-sm mr5 btn-danger btn-raised pull-right " data-dismiss="modal"><i class="fa fa-times-circle-o"></i> {{ trans('app.cancel') }}</button>
             <button type="submit" class="btn btn-sm mr5 btn-success btn-raised pull-right" data-dismis="modal"><i class="fa fa-floppy-o"></i> {{ trans('app.save') }}</button>
        </div>
        {!! Form::close() !!}
    </div>