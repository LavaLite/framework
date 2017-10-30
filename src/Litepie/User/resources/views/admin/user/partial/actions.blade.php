<div class="btn-group">

    <button type="button" class="btn btn-xs btn-warning"><i class="fa fa-gears" aria-hidden="true"></i><span class="hidden-sm hidden-xs">&nbsp;Actions</span></button>
    <button type="button" class="btn btn-xs btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu list" role="menu">
        <li><a class="btn-link" data-url="{{ guard_url('user/user/action/multiple/print') }}"><i class="fa fa-fw fa-print" aria-hidden="true" target="_blank"></i> Print</a></li>

        <li><a class="btn-link" data-url="{{ guard_url('user/user/action/multiple/pdf') }}"><i class="fa fa-fw fa-file-pdf-o" aria-hidden="true"></i> Download PDF</a></li>

        <li><a class="btn-link" data-url="{{ guard_url('user/user/action/multiple/excel') }}"><i class="fa fa-fw fa-file-excel-o" aria-hidden="true"></i> Download Excel</a></li>
        <li class="divider"></li>

        <li><a class="btn-modal" data-url="{{ guard_url('user/user/action/mail') }}" data-title="Send Mail to contact"><i class="fa fa-fw fa-envelope-o" aria-hidden="true"></i> Send Mail</a></li>

        <li><a class="btn-modal" data-url="{{ guard_url('user/user/action/sms') }}" data-title="Send SMS to contact"><i class="fa fa-fw fa-comment-o" aria-hidden="true"></i> Send SMS</a></li>
        <li class="divider"></li>

                <li><a class="btn-action" data-method="POST" data-title="Delete" data-text="Do this data!" data-url="{{ guard_url('user/user/action/delete/temporarily') }}"><i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> Delete</a></li>
        
                <li><a class="btn-action" data-method="POST" data-title="Archive" data-text="Do you want to change the status of this data?" data-url="{{ guard_url('user/user/action/status/archive') }}"><i class="fa fa-fw fa-archive" aria-hidden="true"></i> Archive</a></li>

        
    </ul>
</div>

<div class="modal fade" id="actionModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
              <button type="button" class="close" data-dismiss="modal" aaria-hidden="true">&times;</button>
              <h4 class="modal-title">Send</h4>
            </div>
            <div class="modal-body-area"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    /*$('.btn-link').click(function(e){
        e.preventDefault();
        if(arrayids.length != 0) {
            var formUrl = $(this).data('url');
            var formData = new FormData();
            pushIds("input[name^='id[]']:checked", "ids[]", formData);
            $.ajax({
                url: formUrl,
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success:function(data, textStatus, jqXHR)
                {
                    var w = window.open('about:blank', 'windowname');
                    w.document.write(data);
                    w.document.close();
                }
            });
        } else {
            toastr.error('Please select at least 1 record', 'Error');
        }
    });
*/
    $('.btn-link').click(function(){

        if(arrayids.length != 0) {

            ids = new Array();
            $("input[name^='id[]']:checked").each(function(key, id){
                ids.push($(id).val());
            });

            $(this).attr("href", $(this).data('url') +"/"+ ids.toString());
            $(this).attr("target", "_blank");
           
        } else {
            toastr.error('Please select at least 1 record', 'Error');
        }
    });

    $('.btn-modal').click(function(e){
        e.preventDefault();
        if(arrayids.length != 0) {
            $('#actionModal .modal-title').text($(this).data('title'));
            var formUrl = $(this).data('url');
            var formData = new FormData();
            pushIds("input[name^='id[]']:checked", "ids[]", formData);
            $.ajax({
                url: formUrl,
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success:function(data, textStatus, jqXHR)
                {
                    $('#actionModal .modal-body-area').html(data);
                    $('#actionModal').modal('show');
                }
            });
        } else {
            toastr.error('Please select at least 1 record', 'Error');
        }
    });

    $('.btn-action').click(function(){
        
        if(arrayids.length != 0) {
            var title   = $(this).data('title');
            var text    = $(this).data('text');
            var method  = $(this).data('method');
            var formUrl = $(this).data('url');
            var formData = new FormData();
            pushIds("input[name^='id[]']:checked", "ids[]", formData);
            swal({
                title: "Are you sure?",
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, "+ title +" it!",
                closeOnConfirm: false
            }, function(){
                $.ajax({
                    url: formUrl,
                    type: method,
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    async: false,
                    success:function(data, textStatus, jqXHR)
                    {
                        swal("Updated!", data.message, "success");
                        $('#user-user-list').DataTable().ajax.reload( null, false );
                        arrayids = [];
                    },
                    error:function(data, textStatus, jqXHR)
                    {
                        swal("Failed!", data.message, "error");
                    },
                });
            });

           
        }else{
            toastr.error('Please select at least 1 record', 'Error');
        }
    });

  
});
</script>
