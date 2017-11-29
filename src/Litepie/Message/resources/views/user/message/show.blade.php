<div class="inbox-mail-heading">
  <div class="clearfix">
    <div class="pull-left">
      <span style="font-size:18px;"><b>{!! $messages['caption'] !!}</b></span>
      <div class="btn-group dropdown">

        <a href="#" class="btn btn-danger btn-simple dropdown-toggle" data-toggle="dropdown">
          <i class="material-icons">done</i>
          <i class="caret"></i>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#" class="checkAll">Select All</a></li>

        </ul>
      </div>
      <div class="btn-group">

        @if(@$messages['caption'] == 'Trash')        
          <a href="#" class="btn btn-danger btn-simple btn-deleted"><i class="ion-android-delete"></i></a>
        @else
          <a href="#" class="btn btn-danger btn-simple btn-trashed"><i class="ion-android-delete"></i></a>
        @endif
      </div>
    </div>
    <div class="pull-right">
      <span class="pull-left"></span>
      @include('message::user.message.pagination',['paginator' => $messages['data']])
    </div>
  </div>
</div>
<table class="table table-hover table-inbox mbn table-vam">
    <tbody>
        @forelse($messages['data'] as $key => $value)       
        <?php $class = ($value->read == 1)? '' : 'unread'; ?>   
        <tr class="{!!$class!!}" id="{!!$value->id!!}" class="check-read" data-status="{!!@$value->read!!}">
            <td class="inbox-msg-check" width="60">
                <span class="checkbox lavalite pull-left mn">
                  <input type="checkbox" name="listMessageID" class="checkbox1" value="{!! (@$messages['caption'] == 'Trash')? $value->id : $value->getRouteKey(); !!}" id="message_check_{!!$value->id!!}"/>
                  <label for="option111" class="pln">     </label>
                </span>
            </td>
            <td class="mailbox-star" width="30">
                <a class="btn-starred " data-id="{!!$value->getRouteKey()!!}" style="color:#3e4a56">
                    <i class="fa fa-star @if($value->star == 'Yes') text-yellow @else text-default @endif">
                    </i>
                </a>
            </td>
            <td class="inbox-msg-from hidden-xs hidden-sm single" width="20%"><div>{{ ( @$value['status'] == 'Inbox' )||( @$value['status'] == 'Draft' ) ?  $value['user']['name'] : 'To : '.@$value['to'] }}</div></td>
            <td class="inbox-msg-snip single">{{ ($value->subject != '') ? substr(@$value->subject,0,100) : '&nbsp;' }}</td>
            <td class="inbox-msg-time single " width="12%"><time class="timeago" datetime="{!!$value['created_at']!!}" >{!!format_date(@$value['created_at'])!!}</time></td>
        </tr>
        @empty
        <tr><td colspan="4">No messages</td></tr>
        @endif    
    </tbody>
</table>
<div class="inbox-mail-footer">
    <div class="clearfix">
        <div class="pull-right">
            <span class="pull-left"></span>
            <div class="btn-group pull-right">
                @include('message::user.message.pagination', ['paginator' => $messages['data']])
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $("time .timeago").timeago();
    var arrayIds;
    $("#txt-search").keyup(function(){
        var slug = $(this).val();
        if (slug == '')
            return;
        $('#search-results').load('{{guard_url('message/search')}}'+'/'+slug +'/{{@$messages['caption']}}');
    });

    $(".btn-refresh").click(function(){
        var caption = '{{@$messages['caption']}}';
        $("#txt-search").val('');
        if (caption == ''){
            $('#entry-message').load('{{guard_url('message/status/Inbox')}}');
            return;
        }
        $('#entry-message').load('{{guard_url('message/status')}}/{{@$messages['caption']}}');
    });

    $(".btn-deleted").click(function(){
        arrayIds = [];
        $("input[id^='message_check_']:checked").each(function(){
            arrayIds.push($(this).val());
        });
         if(arrayIds.length != 0){
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function(){
            $.ajax({
                url: "{{guard_url('message/delete')}}",
                type: 'POST',
                data: {arrayIds},
                success:function(data, textStatus, jqXHR)
                {
                    swal("Deleted!", data.message, "success");
                    $('#entry-message').load('{{guard_url('message/status/Trash')}}');
                    $('#inbox_id').html(data.inbox_count);
                    $('#trash_id').html(data.trash_count);
                    $('#draft_id').html(data.draft_count);
                    $('#junk_id').html(data.junk_count);
                    $('#sent_id').html(data.sent_count);
                    $('#starred_id').html(data.starred_count);
                    $('#trash_id').html(data.trash_count);
                },
            });
        });
    }
    });

    $(".checkAll").click(function(){
        if ($(".checkAll").hasClass('all_checked')) {            
            $(".icheckbox_square-blue").removeClass('checked');
            $("input:checkbox").prop('checked', false);
            $(".checkAll").removeClass('all_checked');
            $(".checkAll").html('Select All');            
            return;
        }
       $(".icheckbox_square-blue").addClass('checked');
       $("input:checkbox").prop('checked', true);
       $(".checkAll").addClass('all_checked');
       $(".checkAll").html('Unselect');
    });
    
    $('.btn-starred').click(function(){
        var msg_id = $(this).attr('data-id');
        var star;
        if ($(this).find('i').hasClass('text-yellow')){
            $(this).find('i').removeClass('text-yellow');
            $(this).find('i').addClass('text-default');
            //make sub status not important
            star = 'No' ;
        }
        else{
        $(this).find('i').addClass('text-yellow');
        $(this).find('i').removeClass('text-default');
        //make sub status important
            star = 'Yes' ;
        }
            $.ajax( {
                url: "{{guard_url('message/starred/substatus')}}",
                type: 'GET',
                data: {id:msg_id,star:star},
                beforeSend:function()
                {
                },
                success:function(data, textStatus, jqXHR)
                {

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });


    });

    $('.btn-important').click(function(){
        var msg_id = $(this).attr('data-id');
        var important;
        if ($(this).find('i').hasClass('text-yellow')){
            $(this).find('i').removeClass('text-yellow');
            //make sub status not important
            important = 'No';
        }
        else{
        $(this).find('i').addClass('text-yellow');
        //make sub status important
            important = 'Yes' ;
        }
            $.ajax( {
                url: "{{guard_url('message/important/substatus')}}",
                type: 'GET',
                data: {id:msg_id,important:important},
                beforeSend:function()
                {
                },
                success:function(data, textStatus, jqXHR)
                {

                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });


    });



    $('.btn-trashed').click(function(){

        var arrayIds = [];        
        $("input:checkbox[name=listMessageID]:checked").each(function(){
            arrayIds.push($(this).val());
        });        
        if(arrayIds.length != 0){
              swal({
                title: "Are you sure?",
                text: "You will  be able to recover this data from trash!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            }, function(){   
                $.ajax( {
                        url: "{{guard_url('message/message/status/Trash')}}",
                        type: 'GET',
                        data: {data:arrayIds},
                        beforeSend:function()
                        {
                        },
                        success:function(data, textStatus, jqXHR)
                        {              
                            
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                        }
                    });
               });
            }
    });

    $("#group-msg").change(function(){
        var status = $("#group-msg option:selected" ).val();
        var arrayIds = [];
        var caption = '{{@$messages['caption']}}';
        $("input:checkbox[name=listMessageID]:checked").each(function(){
            arrayIds.push($(this).val());
            console.log($(this).val())
        });
        if(arrayIds.length != 0){
            $.ajax( {
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
        }
    });

  $('.single').click(function(){
              var msgid = $( this ).parent().attr('id');
              var caption = '{{@$messages['caption']}}';
               /*if(caption == '')
                 caption = 'Inbox';*/
               $('#entry-message').load('{{guard_url('message/details/')}}'+'/'+caption+'/'+msgid);
        });

    jQuery("time.timeago").timeago();
});

</script>
