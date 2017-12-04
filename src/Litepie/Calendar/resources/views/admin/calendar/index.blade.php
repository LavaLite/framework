<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-calendar">
            </i>
            {!! trans('calendar::calendar.name') !!}
            <small>
                {!! trans('app.manage') !!} {!! trans('calendar::calendar.names') !!}
            </small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{!! trans_url('admin') !!}">
                    <i class="fa fa-dashboard"> </i>
                    {!! trans('app.home') !!}
                </a>
            </li>
            <li class="active">
                {!! trans('calendar::calendar.names') !!}
            </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
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
            <!-- /.col -->
        </div>
    </section>
</div>




<script type="text/javascript">
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

$( document ).ajaxComplete(function() {
    ini_events($('#external-events div.external-event'));
});

$(function () {
/* initialize the external events
-----------------------------------------------------------------*/
    ini_events($('#external-events div.external-event'));
    /* initialize the calendar
    -----------------------------------------------------------------*/

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
        eventSources: [{
            url: '{!!guard_url('calendar/calendar/ajax/list')!!}', // use the `url` property
        }],
        selectable: true,
        editable: true,
        droppable: true, 
        eventLimit: true,
        eventClick: function(event, element) {     
            $('#event-modal .modal-title').html('Edit ' + event.title);
            $('#event-modal .modal-content').load('{{guard_url('calendar/calendar')}}/' + event.id + '/edit');
            $('#event-modal').modal('show');
        },

        select: function(start, end) {
            $('#event-modal .modal-title').html('Create New Event');
            start = moment(start).format('DD+MMM+YYYY+h:mm+A');
            end = moment(end).format('DD+MMM+YYYY+h:mm+A');
            $('#event-modal .modal-content').load('{{guard_url('calendar/calendar/create')}}?start='+start + '&end='+end);
            $('#event-modal').modal('show');
            var eventData;
            if (event.title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
            }
        },

        drop: function (date, e) { // this function is called when something is dropped
            // retrieve the dropped element's stored Event Object
            eventObject = $(this).data('eventObject');

            formData = new FormData();  

            formData.append('color', $(this).attr("class"));
            formData.append('status', 'Calendar');
            formData.append('title', eventObject.title);
            formData.append('start', date.format('DD MMM YYYY 09:00 A'));
            formData.append('end',  date.format('DD MMM YYYY 10:00 A'));

            createEvents(formData, true);     
            if ($('#drop-remove').is(':checked')) {
                deleteEvents(eventObject.id);
                $(this).remove();
            }
        },

        eventDrop: function(event, delta, revertFunc) {
            formData = new FormData();  
            formData.append('start', event.start.format('DD MMM YYYY 09:00 A'));
            formData.append('end',  event.end.format('DD MMM YYYY 10:00 A'));
            formData.append('_method',  'PUT');
            updateEvents(formData, event.id);
        },

        eventResize: function(event, delta, revertFunc) {
            formData = new FormData();  
            formData.append('start', event.start.format('DD MMM YYYY h:mm A'));
            formData.append('end',  event.end.format('DD MMM YYYY h:mm A'));
            formData.append('_method',  'PUT');
            updateEvents(formData, event.id);
        }
    });

    /* ADDING EVENTS */
     //Red by default
    $("#color-chooser >li >a").click(function (e) {            
        e.preventDefault();
        //Save color
        currColor = $(this).css("color");
        //Add color effect to button
        $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
        $("input:hidden[name=color]").val($(this).attr("class"));
     
    });
   
    $("button#add-new-event").click(function(e){
        var form=$('#create-calendar-calendar');
        if(form.valid() == false) {
            toastr.warning('Please enter event name.', 'Warning');
            return false;
        }

        var formData = new FormData();  
        params   = form.serializeArray();
        $.each(params, function(i, val) {
            formData.append(val.name, val.value);
        });

        $.ajax( {
            url: '{!!guard_url("calendar/calendar")!!}',
            type: 'POST',
            data: formData,
            processData:false,  
            contentType:false,                    
            async: false,
            success:function(data, textStatus, jqXHR)
            {   
                $('#external-events').load('{!!guard_url("calendar/calendar/draft")!!}');
                form[0].reset();
            }
        });
        e.stopImmediatePropagation();
        return false;
    });
        
    
    function updateEvents(formData, id, refresh = false){

        $.ajax( {
            url: "{!!guard_url('calendar/calendar')!!}" +"/"+id,
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            async: false,
            success:function(data, textStatus, jqXHR)
            {
                if (refresh){
                    $('#calendar').fullCalendar('refetchEvents');  
                }
            },
        });
    }

    function createEvents(formData, refresh = false){
        $.ajax( {
            url: "{!!guard_url('calendar/calendar')!!}",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            async: false,
            success:function(data, textStatus, jqXHR)
            {
                if (refresh){
                    $('#calendar').fullCalendar('refetchEvents');  
                }
            },
        });
    }
    function deleteEvents(id){
        $.ajax({
            url: "{!!guard_url('calendar/calendar')!!}" + '/' + id,
            type: 'DELETE',
            processData: false,
            contentType: false,
            async: false,
            success:function(data, textStatus, jqXHR)
            {
            },
        });
    }

});
</script>