<div class="modal-header clearfix">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Create event</h4>
</div>
{!!Form::vertical_open()
->id('create-calendar')
->method('POST')
->files('true')
->action(guard_url('calendar/calendar'))!!}
{!!Form::token()!!}
<div class="modal-body clearfix">
    @include('calendar::admin.calendar.partial.entry')
</div>
<div class="modal-footer clearfix"> 
    <div class='col-md-12 col-sm-12 '>                  
    <button type="button" class="btn  btn-default btn-xs pull-right" style="margin-left: 5px" data-dismiss="modal"><i class="fa fa-times-circle-o"></i> Close</button>    
      
      <button class="btn btn-primary btn-xs pull-right create" type="button"><i class="fa fa-floppy-o"></i> Save</button>
      </div>
</div>
{!!Form::close()!!}
<script type="text/javascript">
$(function() {
    $('.create').click(function() {
        if ($('#create-calendar').valid() == false) {
            toastr.warning('Please enter valid information.', 'Warning');
            return false;
        }
        var formData = new FormData();
        var params = $('#create-calendar').serializeArray();
        $.each(params, function(i, val) {
            formData.append(val.name, val.value);
        });
        $.ajax({
            url: "{!!guard_url('calendar/calendar')!!}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, textStatus, jqXHR) {
                $('#calendar').fullCalendar('refetchEvents');
                $('#event-modal').modal('hide');
            },

        });
    });

});   
</script>
