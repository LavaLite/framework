<div class="inbox-mail-heading">
  <div class="clearfix">
    <div class="pull-left">
      <span style="font-size:18px;"><b>{!! $messages['caption'] !!}</b></span>
      <div class="btn-group dropdown">

        <a href="#" class="btn btn-primary btn-simple dropdown-toggle" data-toggle="dropdown">
          <i class="material-icons">done</i>
          <i class="caret"></i>
        </a>
        <ul class="dropdown-menu">
          <li><a href="#" class="checkAll">Select All</a></li>
          <li><a href="#">Unselect All</a></li>
          <li><a href="#">Another Action</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated Link</a></li>
        </ul>
      </div>

      <div class="btn-group">
        <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-archive"></i></a>
        <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-folder"></i></a>
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
      <td class="inbox-msg-check" width="5%">
        <span class="checkbox pull-left mn">
          <label for="option111" class="pln">
              <input type="checkbox" class="lavalite" id="option111" value="" name="ham">
          </label>
        </span>
      </td>
      <td class="inbox-msg-from hidden-xs hidden-sm single" width="20%"><div>{!!@$value->subject!!}</div></td>
      <td class="inbox-msg-snip single">{!! substr(@$value->message,0,100) !!}</td>
      <td class="inbox-msg-attach single"><!-- <i class="fa fa-paperclip" width="5%"></i> --> </td>
      <td class="inbox-msg-time single" width="12%">{!!format_date(@$value['created_at'])!!}</td>
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
        @include('message::user.message.pagination',['paginator' => $messages['data']])
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    var arrayIds;
    $("#txt-search").keyup(function(){
        var slug = $(this).val();
        if (slug == '')
            return;
        $('#search-results').load('{{URL::to($guard.'/message/search')}}'+'/'+slug +'/{{@$messages['caption']}}');
    });

    $(".btn-refresh").click(function(){
        var caption = '{{@$messages['caption']}}';
        $("#txt-search").val('');
        if (caption == ''){
            $('#entry-message').load('{{URL::to($guard.'/message/status/Inbox')}}');
            return;
        }
        $('#entry-message').load('{{URL::to($guard.'/message/status')}}/{{@$messages['caption']}}');
    });

    $(".btn-deleted").click(function(){
        arrayIds = [];
        $("input[id^='message_check_']:checked").each(function(){
            arrayIds.push($(this).val());
        });
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
                url: "{{trans_url($guard.'/message/delete')}}",
                type: 'POST',
                data: {arrayIds},
                success:function(data, textStatus, jqXHR)
                {
                    swal("Deleted!", data.message, "success");
                        $('#entry-message').load('{{URL::to('admin/message/status/Trash')}}');
                        $('#inbox_id').html(data.inbox_count);
                        $('#trash_id').html(data.trash_count);
                        $('#promotions_id').html(data.promotions_count);
                        $('#draft_id').html(data.draft_count);
                        $('#junk_id').html(data.junk_count);
                        $('#social_id').html(data.social_count);
                        $('#sent_id').html(data.sent_count);
                        $('#starred_id').html(data.starred_count);
                        $('#important_id').html(data.important_count);
                        $('#trash_id').html(data.trash_count);

                },
            });
        });
    });


    $(".checkAll").click(function(){
        if ($(".checkAll").hasClass('all_checked')) {
            $(".icheckbox_square-blue").removeClass('checked');
            $("input:checkbox").prop('checked', false);
            $(".checkAll").removeClass('all_checked');
            return;
        }

       $(".icheckbox_square-blue").addClass('checked');
       $("input:checkbox").prop('checked', true);
       $(".checkAll").addClass('all_checked');
    });
    $('.btn-starred').click(function(){
        var msg_id = $(this).attr('data-id');
        var star;
        if ($(this).find('i').hasClass('text-yellow')){
            $(this).find('i').removeClass('text-yellow');
            //make sub status not important
            star =0;
        }
        else{
        $(this).find('i').addClass('text-yellow');
        //make sub status important
            star =1;
        }
            $.ajax( {
                url: "{{URL::to($guard.'/message/starred/substatus')}}",
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
        if ($(this).find('i').hasClass('text-red')){
            $(this).find('i').removeClass('text-red');
            //make sub status not important
            important =0;
        }
        else{
        $(this).find('i').addClass('text-red');
        //make sub status important
            important =1;
        }
            $.ajax( {
                url: "{{URL::to($guard.'/message/important/substatus')}}",
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
        $.ajax( {
                url: "{{URL::to($guard.'/message/message/status/Trash')}}",
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
                    url: "{{URL::to($guard.'/message/message/status')}}"+"/"+status,
                    type: 'GET',
                    data: {data:arrayIds},
                    success:function(data, textStatus, jqXHR)
                    {
                        console.log("trashed");
                        $('#promotions_id').html(data.promotions_count);  
                         $('#inbox_id').html(data.inbox_count);         
                        $('#social_id').html(data.social_count);                  
                        $('#important_id').html(data.important_count);
                        $('#entry-message').load('{{URL::to($guard.'/message/status/')}}'+'/'+caption);
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
               $('#entry-message').load('{{URL::to($guard.'/message/details/')}}'+'/'+caption+'/'+msgid);
        });

    jQuery("time.timeago").timeago();
});

</script>