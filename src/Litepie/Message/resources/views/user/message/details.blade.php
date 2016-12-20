
{!!Form::vertical_open()
->id('edit-message')
->method('PUT')
->enctype('multipart/form-data')
->action(Trans::to($guard.'/message/message/'. $message->getRouteKey()))!!}
{!!Form::token()!!}  

{!! Form::hidden('read')
    ->forceValue(1)!!}

{!!Form::close()!!}
<div class="inbox-mail-heading">
    <div class="clearfix">
        <div class="pull-left">
            <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-arrow-back"></i></a>
            <div class="btn-group">
                <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-archive"></i></a>
                <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-warning"></i></a>
                <a href="#" class="btn btn-danger btn-simple btn-deleted1"><i class="ion-android-delete"></i></a>
            </div>
            <div class="btn-group dropdown">
                <a href="#" class="btn btn-danger btn-simple dropdown-toggle" data-toggle="dropdown"><i class="ion-android-folder"></i> <i class="caret"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Spam</a></li>
                    <li><a href="#">Trash</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Work</a></li>
                    <li><a href="#">Personal</a></li>
                    <li><a href="#">Others</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Create New</a></li>
                </ul>
            </div>
            <div class="btn-group dropdown">
                <a href="#" class="btn btn-danger btn-simple dropdown-toggle" data-toggle="dropdown">More <i class="caret"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another Action</a></li>
                    <li><a href="#">More Action</a></li>
                    <li><a href="#">Something Else</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated Link</a></li>
                </ul>
            </div>
        </div>
        <div class="pull-right hidden-xs">
            <div class="btn-group">
                <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-arrow-back"></i></a>
                <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-arrow-forward"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="p15">
    <div class="clearfix">
        <h3 class="inbox-read-title pull-left">{!!$message['subject']!!}</h3>
        <a href="#" class="btn btn-default btn-simple pull-right hidden-xs"><i class="ion-printer"></i></a>
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
                    <span class="inbox-read-sender-email mr5 hidden-xs">&lt;{!!$message['from']!!}&gt;</span>
                </div>
                <div><span class="inbox-read-sent-info">to <strong>me</strong>, <a href="#"><strong>{!!$message['user']['name']!!}</strong></a> {!!format_date($message['created_at'])!!}</span></div>
            </div>
        </div>
        <div class="pull-right">
            <div class="btn-group dropdown">
                <a href="#" class="btn btn-danger btn-raised btn-reply"><i class="ion-reply visible-xs"></i><span class="hidden-xs">Reply</span></a>
                <a href="#" class="btn btn-danger btn-raised dropdown-toggle" data-toggle="dropdown">
                    <span class="caret m-n"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </a>
                <ul class="dropdown-menu" style="left:auto;right: 0;" role="menu">
                    <li><a href="#" class="btn-reply">Reply</a></li>
                    <li><a href="#">Reply To All</a></li>
                    <li><a href="#" class="btn-forward">Forward</a></li>
                    <li><a href="#" class="btn-important">Make as important</a></li>
                    <li><a href="#" class="btn-promotions">Move to promotions</a></li>
                    <li><a href="#" class="btn-social">Make to social</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Print</a></li>
                    <li><a href="#">Mark as spam</a></li>
                    <li><a href="#">Mark as unread</a></li>
                    <li><a href="#" class="btn-deleted">Delete this message</a></li>
                </ul>
            </div>
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
                url: "{{trans_url($guard.'/message/message')}}/{{$message->getRouteKey()}}",
                type: 'DELETE',
                processData: false,
                contentType: false,
                dataType: 'json',
                success:function(data, textStatus, jqXHR)
                {
                    swal("Deleted!", data.message, "success");
                    $('#entry-message').load('{{URL::to($guard.'/message/status/Trash')}}');
                },
            });
        });
    });
    $(".btn-deleted1").click(function(){
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
                url: "{{trans_url($guard.'/message/message')}}/{{$message->getRouteKey()}}",
                type: 'DELETE',
                processData: false,
                contentType: false,
                dataType: 'json',
                success:function(data, textStatus, jqXHR)
                {
                    swal("Deleted!", data.message, "success");
                    $('#entry-message').load('{{URL::to($guard.'/message/status/Trash')}}');
                },
            });
        });
    }); 
      
    $('.btn-trashed').click(function(){
        var arrayIds = [];
        arrayIds.push($(this).parent().attr('id'));
        $.ajax( {
                url: "{{URL::to($guard.'/message/message/status/Trash')}}",
                type: 'GET',
                data: {data:arrayIds},
                beforeSend:function()
                {
                },
                success:function(data, textStatus, jqXHR)
                { 
                  var msgcaption = $(".btn-back").attr('id');
                    $('#entry-message').load('{{Trans::to("user/message/status")}}'+'/'+msgcaption);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
    });

    $(".btn-refresh").click(function(){
        var msgid = $( this ).attr('id');
        var caption = '{{@$message['caption']}}';
        $('#entry-message').load('{{URL::to($guard.'/message/details/')}}'+'/'+caption+'/'+msgid);
    });

    $(".btn-back").click(function(){
        var msgcaption = $( this ).attr('id');
          $('#entry-message').load('{{Trans::to("user/message/status")}}'+'/'+msgcaption);

    });

    $(".btn-reply").click(function(){ 
        var to_uid = '{{@$message["id"]}}';
        $('#show-message').load('{{URL::to($guard.'/message/reply')}}'+'/'+to_uid);
    });

    $(".btn-forward").click(function(){
        var to_uid = '{{@$message["id"]}}';
        $('#show-message').load('{{URL::to($guard.'/message/forward')}}'+'/'+to_uid);
    }); 

    $(".btn-important").click(function(){
        var to_uid = '{{@$message->getRouteKey()}}';
        var status = 'Important';
        var arrayIds = [];
        var caption = '{{@$messages["caption"]}}';
        arrayIds.push(to_uid);alert("{{URL::to($guard.'/message/message/status')}}"+"/"+status);
        $.ajax({                    
            url: "{{URL::to($guard.'/message/message/status')}}"+"/"+status,
            type: 'GET',
            data: {data:arrayIds},
            success:function(data, textStatus, jqXHR)
            {
                $('#inbox_id').html(data.inbox_count);                  
                $('#important_id').html(data.important_count);
                /*$('#entry-message').load('{{URL::to($guard.'/message/status/')}}'+'/'+caption);*/
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
        var caption = '{{@$messages["caption"]}}';
        arrayIds.push(to_uid);
        $.ajax({                    
            url: "{{URL::to($guard.'/message/message/status')}}"+"/"+status,
            type: 'GET',
            data: {data:arrayIds},
            success:function(data, textStatus, jqXHR)
            {
                $('#inbox_id').html(data.inbox_count);                  
                $('#promotions_id').html(data.important_count);
                /*$('#entry-message').load('{{URL::to($guard.'/message/status/')}}'+'/'+caption);*/
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
        var caption = '{{@$messages["caption"]}}';
        arrayIds.push(to_uid);
        $.ajax({                    
            url: "{{URL::to($guard.'/message/message/status')}}"+"/"+status,
            type: 'GET',
            data: {data:arrayIds},
            success:function(data, textStatus, jqXHR)
            {
                $('#inbox_id').html(data.inbox_count);                  
                $('#social_id').html(data.important_count);
                /*$('#entry-message').load('{{URL::to($guard.'/message/status/')}}'+'/'+caption);*/
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