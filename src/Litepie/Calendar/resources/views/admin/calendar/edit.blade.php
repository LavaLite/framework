<div class="row"> 
    {!!Form::vertical_open()
    ->id('edit-calendar')
    ->method('PUT')
    ->enctype('multipart/form-data')
    ->action(URL::to('admin/calendar/calendar/'. $calendar->getRouteKey()))!!}
    {!!Form::token()!!}
    <div class="tab-content">
        <div class="tab-pane active" id="details">
            @include('calendar::admin.calendar.partial.entry')
            <div class='col-md-12 col-sm-12 '>
                <button type="button" class="btn  btn-default btn-xs pull-right m-l-5" id="close" data-dismiss="modal"><i class="fa fa-times-circle-o"></i>Close</button>    
                <button type="button" data-dismiss="modal" id="update" class="btn btn-primary btn-xs pull-right m-l-5" ><i class="fa fa-floppy-o"></i> Update</button>              
                  <button type="button" class="btn btn-danger btn-xs pull-right delete-btn m-l-5"><i class="fa fa-trash-o"></i>  Delete </button> 
            </div>
        </div>
    </div>
    {!!Form::close()!!}
</div>
<style type="text/css">
    .m-l-5{margin-left:5px}
</style>
<script type="text/javascript">
$(function(){
    $('#update').click(function(){
        if($('#edit-calendar').valid() == false) {                    
            toastr.warning('Please enter valid information.', 'Warning');
            return false;
        } 
          var formData = new FormData();  
            var params   = $('#edit-calendar').serializeArray();
            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });    
          $.ajax( {
            url: "{!!Trans::to('admin/calendar/calendar')!!}/{{$calendar->getRouteKey()}}",
            type: 'POST',
            data: formData,
            processData:false,
            contentType:false,     
            beforeSend:function()
            {
            },
            success:function(data, textStatus, jqXHR)
            {           
               render();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });       
    }); 
    $('.delete-btn').click(function(){
     swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function(){
        $.ajax( {
            url: "{!!Trans::to('admin/calendar/calendar')!!}/{{$calendar->getRouteKey()}}",
            type: 'DELETE',
            processData:false,
            contentType:false, 
            success:function(data, textStatus, jqXHR)
            {    
                swal("Deleted!", data.message, "success");
                $('#event-modal').modal('hide')     
                 render();                  
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
               
            }
        });
    });  
        
   })

    function render(){
            $('#calendar').fullCalendar('refetchEvents');
        } 
});
   
</script>