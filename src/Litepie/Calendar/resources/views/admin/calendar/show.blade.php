<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h4 class="box-title">
                    Draggable Events
                </h4>
            </div>
            <div class="box-body">
                <!-- the events -->
                <div id="external-events">
                    @forelse($calendars as $key =>
                    $value)
                    <div class="external-event" style="background-color:{!!@$value->color!!};" id="{!!@$value->id!!}">
                        {!!@$value->
                        title!!}
                    </div>
                    @empty
                    @endif
                    <div class="checkbox">
                        <label for="drop-remove">
                            <input type="checkbox" id="drop-remove"/>
                            remove after drop
                        </label>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    Create Event
                </h3>
            </div>
            <div class="box-body">
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                    <!--
                        <button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">
                            Color
                            <span class="caret">
                            </span>
                        </button>
                    -->
                    <ul class="fc-color-picker" id="color-chooser">
                        <li>
                            <a class="text-aqua" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-blue" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-light-blue" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-teal" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-yellow" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-orange" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-green" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-lime" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-red" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-purple" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-fuchsia" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-muted" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a class="text-navy" href="#">
                                <i class="fa fa-square">
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /btn-group -->
                {!!Form::vertical_open()
                ->id('create-calendar-calendar')
                ->method('POST')
                ->files('true')
                ->action(URL::to('admin/calendar/calendar'))!!}
                {!! Form::hidden('color')!!}
                {!! Form::hidden('start')
                ->forceValue(date('Y-m-d H:i:s'))!!}
                {!! Form::hidden('end')
                ->forceValue(date('Y-m-d 12:00:00'))!!}
                {!! Form::hidden('temp_id')
                ->forceValue('0')!!}
                <div class="input-group">
                    <input type="text" name="title" id="input-title" class="form-control" placeholder="Event Title"/>
                    <div class="input-group-btn">
                        <button id="add-new-event" type="button" class="btn btn-primary btn-flat">
                            Add
                        </button>
                    </div>
                    <!-- /btn-group -->
                </div>
                <!-- /input-group -->
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>

@section('script')
<script type="text/javascript">
    var tempId = 0;
    $(function () {
    /* initialize the external events
    -----------------------------------------------------------------*/
    function ini_events(ele) {
    ele.each(function () {
    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
    // it doesn't need to have a start or end
    var eventObject = {
    title: $.trim($(this).text()), // use the element's text as the event title
    id: $.trim($(this).attr('id')) // use the element's text as the event title
    };
    // store the Event Object in the DOM element so we can get to it later
    $(this).data('eventObject', eventObject);
    // make the event draggable using jQuery UI
    $(this).draggable({
    zIndex: 1070,
    revert: true, // will cause the event to go back to its
    revertDuration: 0  //  original position after the drag
    });
    });
    }
    ini_events($('#external-events div.external-event'));
    /* initialize the calendar
    -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
    m = date.getMonth(),
    y = date.getFullYear();
    $('#calendar').fullCalendar({
    header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
    },
    buttonText: {
    today: 'today',
    month: 'month',
    week: 'week',
    day: 'day'
    },
    //Random default events
    eventSources: [
    // your event source
    {
    url: '{!!URL::to('admin/calendar/calendar/ajax/list')!!}', // use the `url` property
    }
    ],
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar !!!
    drop: function (date,allDay) { // this function is called when something is dropped
    // retrieve the dropped element's stored Event Object
    var originalEventObject = $(this).data('eventObject');
    // we need to copy it, so that multiple events don't have a reference to the same object
    var copiedEventObject = $.extend({}, originalEventObject);
    // assign it the date that was reported
    var tempDate = new Date(date);  //clone date
    copiedEventObject.start = date;
    var end = new Date(tempDate.setHours(tempDate.getHours()+1)); //
        copiedEventObject.allDay = false;  //< -- only change
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");
        var title = copiedEventObject.title;
        var start = date.format('YYYY-MM-DD 00:00');
        var end = date.format('YYYY-MM-DD 01:00');
        var status;
        if ($('#drop-remove').is(':checked'))
        status = 'Calendar';
        else
        status = 'Both';
        var formData = 'start='+start+'&end='+end+'&status='+status+'&title='+title+'&color='+copiedEventObject.backgroundColor;
        updateEvents(formData,copiedEventObject.id);
        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
        // if so, remove the element from the "Draggable Events" list
        $(this).remove();
        }
        },
        eventDrop: function(event, delta, revertFunc) {
        var formData = 'start='+event.start.format()+'&end='+event.end.format();
        updateEvents(formData,event.id);
        },
        eventResize: function(event, delta, revertFunc) {
        alert('test');
        var formData = 'start='+event.start.format()+'&end='+event.end.format();
        updateEvents(formData,event.id);
        },
        });
        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser >li >a").click(function (e) {
        e.preventDefault();
        //Save color
        currColor = $(this).css("color");
        //Add color effect to button
        $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        });
        $("#add-new-event").click(function (e) {
        e.preventDefault();
        //Get value and make sure it is not null
        var val = $("input:text[name=title]").val();
        if (val.length == 0) {
        return;
        }
        //Create events
        var event = $("<div/>");
        event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
        event.html(val);
        $('#external-events').prepend(event);
        //Add draggable funtionality
        ini_events(event);
        $("input:hidden[name=color]").val(currColor);
        $('#create-calendar-calendar').submit();
        });
        $('#create-calendar-calendar').submit( function( e ) {
        if($('#create-calendar-calendar').valid() == false) {
        toastr.error('Unprocessable entry.', 'Warning');
        return false;
        }
        $.ajax( {
        url: $(this).attr('action'),
        type: 'POST',
        data: new FormData( this ),
        processData: false,
        contentType: false,
        beforeSend:function()
        {
        },
        success:function(data, textStatus, jqXHR)
        {
            $('#entry-calendar').load('{!!URL::to('admin/calendar/calendar/show')!!}');
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        }
        });
        e.preventDefault();
        });
        function updateEvents(formData,id){
        $.ajax( {
        url: "{!!URL::to('admin/calendar/calendar')!!}" +"/"+id,
        type: 'PUT',
        data: {data:formData},
        beforeSend:function()
        {
        },
        success:function(data, textStatus, jqXHR)
        {
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
        }
        });
        }
        });
    </script>
@show
@section('style')
<style type="text/css">
    .external-event{
    color: #fff;
    }
    .fc-time{
       display : none;
    }
</style>
@show
