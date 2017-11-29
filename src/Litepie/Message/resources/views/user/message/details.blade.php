
{!!Form::vertical_open()
->id('edit-message')
->method('PUT')
->enctype('multipart/form-data')
->action(guard_url('message/message/'. $message->getRouteKey()))!!}
{!!Form::token()!!}  

{!! Form::hidden('read')
    ->forceValue(1)!!}
{!!Form::close()!!}
<div class="inbox-mail-heading">
    <div class="clearfix">
        <div class="pull-left">
            <a href="#" class="btn btn-danger btn-simple btn-back"><i class="ion-android-arrow-back"></i></a>
            @if(@$message['status'] == 'Trash')
            <div class="btn-group">
                <a href="#" class="btn btn-danger btn-simple btn-deleted"><i class="ion-android-delete"></i></a>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="p15">
    <div class="clearfix">
        <h3 class="inbox-read-title pull-left">{!!$message['subject']!!}</h3>
        <div class="btn-group dropdown pull-right">
            <a href="#" class="btn btn-danger btn-raised "><i class="ion-reply visible-xs"></i><span class="hidden-xs">More</span></a>
            <a href="#" class="btn btn-danger btn-raised dropdown-toggle" data-toggle="dropdown">
                <span class="caret m-n"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </a>
            <ul class="dropdown-menu" style="left:auto;right: 0;" role="menu">
                <li><a href="#" class="btn-reply">Reply</a></li>
                <li><a href="#" class="btn-forward">Forward</a></li>
                <li><a href="#" class="btn-important">Make as important</a></li>
                <li><a href="#" class="btn-promotions">Move to promotions</a></li>
                <li><a href="#" class="btn-social">Move to social</a></li>
            </ul>
        </div>
    </div>
    <hr class=" mb-md">
    <div class="inbox-read-details clearfix">
        <div class="pull-left">
            <div class="media-left">
                <img class="inbox-read-sender-avatar img-circle" src="{{users('picture')}}" alt="Dangerfield">
            </div>
            <div class="media-body">
                <div>
                    <span class="inbox-read-sender-name mr5">{!!$message['user']['name']!!}</span>
                    <span class="inbox-read-sender-email mr5 hidden-xs">&lt;{!!$message['user']['email']!!}&gt;</span>
                </div>
                <div><span class="inbox-read-sent-info">to <a href="#"><strong>{!!$message['to']!!}</strong></a> {!!format_date($message['created_at'])!!}</span></div>
            </div>
        </div>
        <div class="pull-right">
            
        </div>
    </div>
    <hr class=" mt-md">
    <div class="msg-body">
        <p>{!!$message['message']!!}</p>
        <br>
    </div>
    <hr/>
    <div id="show-message">
        
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
                console.log(data.inbox_count);
                $('#inbox_id').html(data.inbox_count); 
                $('#sent_id').html(data.sent_count);
                $('#draft_id').html(data.draft_count);

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
                url: "{{guard_url('message/message')}}/{{$message->getRouteKey()}}",
                type: 'DELETE',
                processData: false,
                contentType: false,
                dataType: 'json',
                success:function(data, textStatus, jqXHR)
                {
                    swal("Deleted!", data.message, "success");
                    $('#trash_id').html(data.trash_count);
                    $('#entry-message').load('{{guard_url('message/status/Trash')}}');
                },
            });
        });
    });

      
    $('.btn-trashed').click(function(){
        var arrayIds = [];
        arrayIds.push($(this).parent().attr('id'));
        $.ajax( {
                url: "{{guard_url('message/message/status/Trash')}}",
                type: 'GET',
                data: {data:arrayIds},
                beforeSend:function()
                {
                },
                success:function(data, textStatus, jqXHR)
                { 
                  var msgcaption = $(".btn-back").attr('id');
                  $('#trash_id').html(data.trash_count);
                  $('#entry-message').load('{{guard_url("message/status")}}'+'/'+msgcaption);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
    });

    $(".btn-refresh").click(function(){
        var msgid = $( this ).attr('id');
        var caption = '{{@$message["caption"]}}';
        $('#entry-message').load('{{guard_url('message/details/')}}'+'/'+caption+'/'+msgid);
    });

    $(".btn-back").click(function(){
        var msgcaption = '{{@$message["caption"]}}';
        $('#entry-message').load('{{guard_url("message/status")}}'+'/'+msgcaption);

    });

    $(".btn-reply").click(function(){ 
        var to_uid = '{{@$message["id"]}}';
        $('#show-message').load('{{guard_url('message/reply')}}'+'/'+to_uid);
    });

    $(".btn-forward").click(function(){
        var to_uid = '{{@$message["id"]}}';
        $('#show-message').load('{{guard_url('message/forward')}}'+'/'+to_uid);
    }); 

    $(".btn-important").click(function(){
        var to_uid = '{{@$message->getRouteKey()}}';
        var status = 'Important';
        var arrayIds = [];
        var caption = '{{@$message["caption"]}}';
        arrayIds.push(to_uid);
        $.ajax({                    
            url: "{{guard_url('message/message/status')}}"+"/"+status,
            type: 'GET',
            data: {data:arrayIds},
            success:function(data, textStatus, jqXHR)
            {
                $('#inbox_id').html(data.inbox_count);
                $('#entry-message').load('{{guard_url('message/status/')}}'+'/'+caption);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });

    }); 
    $(".btn-promotions").click(function(){
        var to_uid = '{{@$message->getRouteKey()}}';
        var status = 'Promotions';
        var arrayIds = [];
        var caption = '{{@$message["caption"]}}';
        arrayIds.push(to_uid);
        $.ajax({                    
            url: "{{guard_url('message/message/status')}}"+"/"+status,
            type: 'GET',
            data: {data:arrayIds},
            success:function(data, textStatus, jqXHR)
            {
                $('#inbox_id').html(data.inbox_count);
                $('#entry-message').load('{{guard_url('message/status/')}}'+'/'+caption);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });

    });  
    $(".btn-social").click(function(){
        var to_uid = '{{@$message->getRouteKey()}}';
        var status = 'Social';
        var arrayIds = [];
        var caption = '{{@$message["caption"]}}';
        arrayIds.push(to_uid);
        $.ajax({                    
            url: "{{guard_url('message/message/status')}}"+"/"+status,
            type: 'GET',
            data: {data:arrayIds},
            success:function(data, textStatus, jqXHR)
            {
                $('#inbox_id').html(data.inbox_count);
                $('#entry-message').load('{{guard_url('message/status/')}}'+'/'+caption);
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
</style>