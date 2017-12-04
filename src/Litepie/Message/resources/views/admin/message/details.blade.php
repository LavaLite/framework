<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            {!!$message['subject']!!}  <span class="lbl">{!!@$message['caption']!!}</span>
        </h3>
    </div>
    <!-- /.box-header -->

    {!!Form::vertical_open()
    ->id('edit-message')
    ->method('PUT')
    ->enctype('multipart/form-data')
    ->action(guard_url('message/message/'. $message->getRouteKey()))!!}
    {!!Form::token()!!}  

    {!! Form::hidden('read')
        ->forceValue(1)!!}

    {!!Form::close()!!}

    <div class="box-body no-padding">
        <div class="mailbox-controls" >
          
            <div class="btn-group" id="{!!$message->getRouteKey()!!}">
                <button class="btn btn-default btn-sm btn-back" title="Back" id="{!!@$message['caption']!!}">
                    <i class="fa fa-long-arrow-left">
                    </i>
                </button> 
                @if(@$message['status'] == 'Trash')
                <button class="btn btn-default btn-sm btn-deleted" title="Delete forever" >
                    Delete forever
                </button>
                @else
                <button class="btn btn-default btn-sm btn-trashed" title="Move to Trash">
                    <i class="fa fa-trash-o" >
                    </i>
                </button>
                @endif
                <button class="btn btn-default btn-sm btn-reply" id="{!!$message['id']!!}" title="Reply">
                    <i class="fa fa-reply">
                    </i>
                </button>
                <button class="btn btn-default btn-sm btn-forward" title="Forward" id="{!!$message['id']!!}">
                    <i class="fa fa-share">
                    </i>
                </button>
           
            <!-- /.btn-group -->
            <button class="btn btn-default btn-sm btn-refresh" title="Refresh" id="{!!$message['id']!!}">
                <i class="fa fa-refresh">
                </i>
            </button> 
            </div>
            <div class="pull-right">
                {!! Form::select('group-status','')
               ->id('msg-options')
               -> options(['Important' => 'Important', 'Promotions' => 'Promotions', 'Social' => 'Social'])
               -> placeholder('More')!!}
            </div>
     
        </div>
        <div class="table-responsive mailbox-messages" style="min-height: 360px;">
            <table class="table  table-striped">
                <tbody id="search-results">
                 	<tr>
                        <td colspan="4">
                          From: {!!$message['user']['name']!!}<br/>
                          Date: {!!$message['created_at']!!}<br/>
                          Subject: {!!$message['subject']!!}<br/>
                          To:{!!$message['to']!!}<br/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                          {!!$message['message']!!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- /.table -->
        </div>
        <!-- /.mail-box-messages -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer no-padding" id="show-message">
        <div class="mailbox-controls" >
            <div class="btn-group" id="{!!$message->getRouteKey()!!}">
               <button class="btn btn-default btn-sm btn-back" title="Back" id="{!!$message['caption']!!}">
                    <i class="fa fa-long-arrow-left">
                    </i>
                </button> 
                @if(@$message['status'] == 'Trash')
                <button class="btn btn-default btn-sm btn-deleted" title="Delete forever" >
                    Delete forever
                </button>
                @else
                <button class="btn btn-default btn-sm btn-trashed" title="Move to Trash">
                    <i class="fa fa-trash-o" >
                    </i>
                </button>
                @endif
                <button class="btn btn-default btn-sm btn-reply" id="{!!$message['id']!!}" title="Reply">
                    <i class="fa fa-reply"></i>
                </button>
                <button class="btn btn-default btn-sm btn-forward"  id="{!!$message['id']!!}" title="Forward">
                    <i class="fa fa-share"></i>
                </button>
                <button class="btn btn-default btn-sm btn-refresh" title="Refresh" id="{!!$message['id']!!}">
                    <i class="fa fa-refresh">
                    </i>
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    
    @if($message->read != 1)
        var form = $('#edit-message');
        var formData = new FormData($('#edit-message'));
        params   = form.serializeArray();
        $.each(params, function(i, val) {
            formData.append(val.name, val.value);
        });
        var url  = form.attr('action');

        $.ajax( {
            url: url,
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success:function(data, textStatus, jqXHR)
            {
                $('#inbox_id').html(data.inbox_count);
            }
        });
    @endif
    
    $(".btn-deleted").click(function(){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function(){
            var data = new FormData();
            $.ajax({
                url: "{{trans_url('admin/message/message')}}/{{$message->getRouteKey()}}",
                type: 'DELETE',
                processData: false,
                contentType: false,
                dataType: 'json',
                success:function(data, textStatus, jqXHR)
                {
                    swal("Deleted!", data.message, "success");
                    $('#entry-message').load('{{trans_url('admin/message/status/Trash')}}');
                },
            });
        });
    });    


    $('.btn-trashed').click(function(){
        var arrayIds = [];
        arrayIds.push($(this).parent().attr('id'));
        $.ajax( {
                url: "{{trans_url('admin/message/message/status/Trash')}}",
                type: 'GET',
                data: {data:arrayIds},
                beforeSend:function()
                {
                },
                success:function(data, textStatus, jqXHR)
                { 
                  var msgcaption = $(".btn-back").attr('id');
                    $('#entry-message').load('{{Trans::to("admin/message/status")}}'+'/'+msgcaption);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
    });

    $(".btn-refresh").click(function(){
        var msgid = $( this ).attr('id');
        var caption = '{{@$message['caption']}}';
        $('#entry-message').load('{{trans_url('admin/message/details/')}}'+'/'+caption+'/'+msgid);
    });

    $(".btn-back").click(function(){
        var msgcaption = $( this ).attr('id');
          $('#entry-message').load('{{Trans::to("admin/message/status")}}'+'/'+msgcaption);

    });

    $(".btn-reply").click(function(){
        var to_uid = $( this ).attr('id');
        $('#show-message').load('{{trans_url('admin/message/reply')}}'+'/'+to_uid);
    });

    $(".btn-forward").click(function(){
        var to_uid = $( this ).attr('id');
        $('#show-message').load('{{trans_url('admin/message/forward')}}'+'/'+to_uid);
    }); 

    $("#msg-options").change(function(){
        var status = $("#msg-options option:selected" ).val();
        var to_uid = '{{@$message->getRouteKey()}}';
        var status = status;
        var arrayIds = [];
        var caption = '{{@$message["caption"]}}';
        arrayIds.push(to_uid);
        $.ajax({                    
            url: "{{trans_url('admin/message/message/status')}}"+"/"+status,
            type: 'GET',
            data: {data:arrayIds},
            success:function(data, textStatus, jqXHR)
            {
                $('#inbox_id').html(data.inbox_count);
                $('#entry-message').load('{{trans_url('admin/message/status/')}}'+'/'+caption);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                
            }
        });

    }); 
});
</script>
<style type="text/css">
	.lbl{
		    font-size: 11px;
    background-color: rgb(221, 221, 221);
    margin: 7px;
    padding: 0px 6px;
	}
    .btn-group button{
        min-width: 60px;
        padding: 5px;
        margin: 10px 15px;
    }
</style>