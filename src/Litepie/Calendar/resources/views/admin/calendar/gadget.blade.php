
    <div class="no-padding">
       <div id="calendar"></div>
    </div>
    @push('scripts')
        <script src="/example.js"></script>
    @endpush
@section('script')
<script type="text/javascript">
$(function () {

    $('#calendar').fullCalendar({
        contentHeight: 635,
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
        url: '{!!guard_url('calendar/calendar/ajax/list')!!}', // use the `url` property
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
<style type="text/css">
    .external-event{
    color: #fff;
    }
    .fc-time{
       display : none;
    }
    .fc-state-active,.fc-state-disabled,.fc-state-hover{
        color: #000 !important;
    }
    .fc-state-default {
        background-color: #12d6cc;
        color: #fff;
        border: none;
    }
</style>
@show
