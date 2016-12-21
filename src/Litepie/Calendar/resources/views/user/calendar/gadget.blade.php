<div class="no-padding card-calendar">
   <div id="calendar"></div>
</div>
@section('script')
<script type="text/javascript">
$(function () {
    $('#calendar').fullCalendar({
        contentHeight: 660,
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
        editable: false,
        droppable: false, // this allows things to be dropped onto the calendar !!!
        resizable: false,
        eventLimit: true,
    });
       
});
</script>
@show
@section('style')

@show
