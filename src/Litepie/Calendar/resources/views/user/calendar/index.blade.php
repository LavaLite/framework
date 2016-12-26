<!-- @include('public::notifications') -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default alt">
                <div class="heading">
                    <h2>Draggable Events</h2>
                </div>
                <div class="body">
                    <div id="external-events" class="clearfix">
                        @forelse($calendars as $key =>$value)
                            <div class="external-event {!!@$value['color']!!}" id="{!!$value->getRouteKey()!!}">
                                {!!@$value['title']!!}
                            </div>
                        @empty
                        @endif
                        <div class="checkbox checkbox-inline mt20 pull-left pln">
                            <label for="drop-remove"><input id="drop-remove" class="lavalite" type="checkbox"><span class="ml10">Remove after drop</span></label>
                        </div>                                    
                    </div>
                    
                    <hr>

                    <div class="event-color-block">
                        <ul class="fc-color-picker" id="color-chooser">
                            <li>
                                <a class="event-azure" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-purple" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-blue" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-green" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-orange" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-red" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-rose" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-pink" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-indigo" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                            <li>
                                <a class="event-default" href="#">
                                    <i class="ion ion-record">
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                     {!!Form::vertical_open()
                    ->id('create-calendar-calendar')
                    ->method('POST')
                    ->class('mt30')
                    ->files('true') 
                    ->enctype('multipart/form-data')!!}
                    {!!Form::token()!!}

                    {!! Form::hidden('color')->id('color')->value('event-red')!!}
                    {!! Form::hidden('status')->forceValue('Draft')!!}
                    {!! Form::hidden('start')
                    ->forceValue(date('Y-m-d H:i:s'))!!}
                    {!! Form::hidden('end')
                    ->forceValue(date('Y-m-d 12:00:00'))!!}
                    {!! Form::hidden('temp_id')
                    ->forceValue('0')!!}
                        <div class="form-group label-floating mn pn">
                            <div class="input-group mn pn">
                                <label for="" class="control-label">Event Title</label>
                                <input type="text" name="title" id="input-title" class="form-control mn">

                                <span class="input-group-btn prn">
                                    <button type="button" id="add-new-event" class="btn btn-icon btn-round btn-danger btn-raised">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-calendar mn">
                <div class="content pn">
                    <div id="fullCalendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="event-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Calendar</h4>
            </div>
            <div class="modal-body">
                <p>Loading &hellip;</p>
            </div>
            <div class="modal-footer"> 
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    
</style>
<script type="text/javascript">
var tempId = 0;
$(function () {
/* initialize the external events
-----------------------------------------------------------------*/
    function ini_events(ele) {
        ele.each(function () {
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
    $('#fullCalendar').fullCalendar({
      header: {
                    left: 'title',
                    center: 'month,agendaWeek,agendaDay',
                    right: 'prev,next today'
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
        url: '{!!Trans::to($guard.'/calendar/calendar/ajax/list')!!}', // use the `url` property
        }
        ],
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        selectable: true, // this allows things to be dropped onto the calendar !!!
        eventLimit: true,
        eventClick: function(event, element) {
            $('#event-modal .modal-title').html('Edit ' + event.title);
            $('#event-modal .modal-body').load('{{URL::to($guard.'/calendar/calendar')}}/' + event.id + '/edit');
            $('#event-modal').modal('show');
/* $('.modal-footer #event-delete').css('display','block');*/
        },

        select: function(start, end) {
            $('#event-modal .modal-title').html('Create New Event');
             var startdate = start.format('YYYY-MM-DD');            
             var enddate = end.format('YYYY-MM-DD');           
            $('#event-modal .modal-body').load('{{URL::to($guard.'/calendar/calendar/create')}}?start='+startdate+'&end='+enddate);         
            $('#event-modal').modal('show');
            var eventData;
            if (event.title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };


            //$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            //$('#calendar').fullCalendar('unselect');
        },
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
            copiedEventObject.className = $(this).attr("class");
            var title = copiedEventObject.title;
            var start = date.format('YYYY-MM-DD 00:00');
            var end = date.format('YYYY-MM-DD 01:00');
            var status;
            if ($('#drop-remove').is(':checked'))
            status = 'Calendar';
            else
            status = 'Both';
            var formData = 'start='+start+'&end='+end+'&status='+status+'&title='+title+'&color='+copiedEventObject.className;
            updateEvents(formData,copiedEventObject.id);
            
                if ($('#drop-remove').is(':checked')) {
                    $(this).remove();
                }
            },
            eventDrop: function(event, delta, revertFunc) {
                var formData = 'start='+event.start.format()+'&end='+event.end.format()+'&status='+status;
                updateEvents(formData,event.id);
            },
            eventResize: function(event, delta, revertFunc) {
                var formData = 'start='+event.start.format()+'&end='+event.end.format()+'&status='+status;
                updateEvents(formData,event.id);
            },
    });


      $("#color-chooser >li >a").click(function (e) {            
            e.preventDefault();
            var currColor = "#0073b7";
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            $('#add-new-event').css({"background-color": currColor, "border-color": currColor,"color":"#fff"});
            $("input:hidden[name=color]").val($(this).attr("class"));
         
        });
       
        $("#add-new-event").click(function(e){   
                e.preventDefault();
                         
                var form=$('#create-calendar-calendar');
                if(form.valid() == false) {
                     toastr.error('Please enter title.', 'Error');
                    return false;
                }              
               
                    var formData = new FormData();  
                    params   = form.serializeArray();
                    $.each(params, function(i, val) {
                        formData.append(val.name, val.value);
                    });                   
              
                $.ajax( {
                            url: '{!!url($guard."/calendar/calendar")!!}',
                            type: 'POST',
                            data: formData,
                            processData:false,  
                            contentType:false,                    
                            success:function(data, textStatus, jqXHR)
                            {   
                             $("#input-title").val('');
                             $('#external-events').load('{!!url($guard."/calendar/calendar/draft")!!}');                          

                            },
                            error: function(jqXHR, textStatus, errorThrown)
                            {
                             
                            }
                        });

                  
                 
            });
   
    
    function updateEvents(formData,id){     

        $.ajax( {
            url: "{!!Trans::to($guard.'/calendar/calendar')!!}" +"/"+id,
            type: 'PUT',
            data: {data:formData},
            beforeSend:function()
            {
            },
            success:function(data, textStatus, jqXHR)
            {
             $('#fullCalendar').fullCalendar('refetchEvents');  
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });
    }


});
</script>