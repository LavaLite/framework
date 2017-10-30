<div class="box box-primary">    
    <div class="box-body no-padding">
        <div class="mailbox-controls">
            <div class="row">
                <div class="col-sm-12">                    
                    <div class="card-box">
                        <div class="p-20">
                            <h5 class="box-title">COMPOSE MESSAGE</h5>
                            {!!Form::vertical_open()
                            ->id('create-message-message')
                            ->method('POST')
                            ->files('true')
                            ->action(trans_url('admin/message/message'))!!}
                            {!! Form::hidden('status')
                             -> forceValue("Sent")!!}

                            <div class="form-group">
                            {!! Form::select('mails[]')
                            -> class('select-search')
                            -> dataUrl(guard_url('message/message/users'))
                            -> style('width:100%')
                            -> multiple()
                            -> required()
                            -> raw()!!}
                            </div>

                            <div class="form-group">
                            {!! Form::text('subject')
                            -> placeholder("Subject")
                            -> required()                       
                            -> raw()!!}
                            </div>

                            <div class="form-group">
                            {!! Form::textarea ('message')
                            -> placeholder("Message")
                            -> required()
                            -> rows(6)
                            -> raw()!!}
                            </div>
                            {!! Form::close() !!}

                            <button type="button" class="btn btn-default pull-right m-l-5" id="btn-close">Cancel</button>
                            <button type="button" class="btn btn-primary pull-right m-l-5" id="btn-send">Save</button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>  
<script type="text/javascript">
$(function () {
        $('#btn-send').click(function(){
            $('#create-message-message').submit();
        });

        $('#btn-close').click(function(){
            if ($("#to").val() == '') {
                return;
            }
            $("input:hidden[name=status]").val('Draft');
            $('#create-message-message').submit();
        });
        
        $('#create-message-message').submit( function( e ) {
            if($('#create-message-message').valid() == false) {
                toastr.warning('Please enter valid information', 'Warning');
                return false;
            }
            var url  = $(this).attr('action');
            var formData = new FormData( this );
            var status = $("#status").val();
            $.ajax( {
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend:function()
                {
                    $('#btn-send').prop('disabled',true);
                    $('#btn-draft').prop('disabled',true);
                    $('#btn-trash-delete').prop('disabled',true);
                },
                success:function(data, textStatus, jqXHR)
                {
                    $('#entry-message').load('{{trans_url('admin/message/status/Inbox')}}');
                    $('#inbox_id').html(data.inbox_count);
                    $('#draft_id').html(data.draft_count);
                    $('#sent_id').html(data.sent_count);
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    $('#btn-send').prop('disabled',false);
                    $('#btn-draft').prop('disabled',false);
                    $('#btn-trash-delete').prop('disabled',false);
                }
            });
            e.preventDefault();
        });
   });
</script>