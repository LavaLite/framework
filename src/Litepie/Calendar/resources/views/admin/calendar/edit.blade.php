<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Update event</h4>
</div>
{!!Form::vertical_open()
->id('edit-calendar-calendar')
->method('PUT')
->enctype('multipart/form-data')
->action(guard_url('calendar/calendar/'. $calendar->getRouteKey()))!!}
{!!Form::token()!!}
<div class="modal-body clearfix">
    @include('calendar::admin.calendar.partial.entry')
</div>
<div class="modal-footer"> 
    <div class='col-md-12 col-sm-12 '>
        <button type="button" class="btn  btn-default btn-xs pull-right m-l-5" id="close" data-dismiss="modal"><i class="fa fa-times-circle-o"></i>Close</button>    
        <button type="button" data-dismiss="modal" id="" class="btn btn-primary btn-xs pull-right update m-l-5" ><i class="fa fa-floppy-o"></i> Update</button>              
          <button type="button" class="btn btn-danger btn-xs pull-right delete m-l-5"><i class="fa fa-trash-o"></i>  Delete </button> 
    </div>
</div>
{!!Form::close()!!}

<script type="text/javascript">
$(function() {
    $('.update').click(function() {
        if ($('#edit-calendar-calendar').valid() == false) {
            toastr.warning('Please enter valid information.', 'Warning');
            return false;
        }
        var formData = new FormData();
        var params = $('#edit-calendar-calendar').serializeArray();
        $.each(params, function(i, val) {
            formData.append(val.name, val.value);
        });
        $.ajax({
            url: "{!!guard_url('calendar/calendar')!!}/{{$calendar->getRouteKey()}}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,

            success: function(data, textStatus, jqXHR) {
                $('#calendar').fullCalendar('refetchEvents');
            },

        });
    });

    $('.delete').click(function() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            $.ajax({
                url: "{!!guard_url('calendar/calendar')!!}/{{$calendar->getRouteKey()}}",
                type: 'DELETE',
                processData: false,
                contentType: false,
                success: function(data, textStatus, jqXHR) {
                    swal("Deleted!", data.message, "success");
                    $('#event-modal').modal('hide')
                    $('#calendar').fullCalendar('refetchEvents');
                },
                error: function(jqXHR, textStatus, errorThrown) {

                }
            });
        });

    })

});   
</script>