<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
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

<script type="text/javascript">
var tempId = 0;
$(function () {
/* initialize the external events
-----------------------------------------------------------------*/

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
            url: '{!!guard_url('calendar/calendar/ajax/list')!!}', 
            // use the `url` property
        }
        ],
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar !!!
        selectable: true, // this allows things to be dropped onto the calendar !!!
        eventLimit: true,
        eventClick: function(event, element) {
            $('#event-modal .modal-title').html('Edit ' + event.title);
            $('#event-modal .modal-body').load('{{guard_url('calendar/calendar')}}/' + event.id + '/edit');
            $('#event-modal').modal('show');
        },

        select: function(start, end) {
            $('#event-modal .modal-title').html('Create New Event');
             var startdate = moment(start).format('YYYY-MM-DD');            
             var enddate = moment(end).format('YYYY-MM-DD');           
            $('#event-modal .modal-body').load('{{guard_url('calendar/calendar/create')}}?start='+startdate+'&end='+enddate);         
            $('#event-modal').modal('show');
            var eventData;
            if (event.title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
            }
        }
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

    function updateEvents(formData,id){     

        $.ajax( {
            url: "{!!guard_url('calendar/calendar')!!}" +"/"+id,
            type: 'PUT',
            data: {data:formData},
            success:function(data, textStatus, jqXHR)
            {
                $('#fullCalendar').fullCalendar('refetchEvents');  
            }
        });
    }
});
</script>