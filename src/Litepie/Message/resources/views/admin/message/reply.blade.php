            {!!Form::vertical_open()
                ->id('reply-message-message')
                ->method('POST')
                ->files('true')
                ->action(trans_url('admin/message/message'))!!}
                {!! Form::hidden('status')
                 -> forceValue("Sent")!!}
                 {!! Form::hidden('subject')!!}
            <table class="table  table-striped">
                <tbody>
                 	
                    <tr>
                        <td colspan="4">
                            {!! Form::email('to')
                            -> value($message['user']->email)
                            -> required()
                            -> raw()!!}
                        </td>
                    </tr>
                        {!! Form::hidden('subject')
                        -> value("Re: ".$message['subject']) !!}
                        {!! Form::hidden('mails[]')
                        -> value($message['user']->email) !!}
                    <tr>
                        <td colspan="4">
                            {!! Form::textarea ('message')
                            -> placeholder("Message")
                            -> required()
                            -> rows(6)
                            -> raw()!!}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <button type="button" class="btn btn-primary" id="reply-send"><i class="fa fa-check"></i> Send</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            {!! Form::close() !!}

            <script type="text/javascript">
            $(document).ready(function(){
                $('#reply-send').click(function(){
                    $('#reply-message-message').submit();
                });
                $('#reply-message-message').submit( function( e ) {
                    if($('#reply-message-message').valid() == false) {
                        toastr.error('Unprocessable entry.', 'Warning');
                        return false;
                    }
                    var url  = $(this).attr('action');
                    var formData = new FormData( this );

                    $.ajax( {
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend:function()
                        {
                            $('#reply-send').prop('disabled',true);
                            $('#reply-close').prop('disabled',true);
                        },
                        success:function(data, textStatus, jqXHR)
                        { 
                            $('#inbox_id').html(data.inbox_count);           
                            $('#sent_id').html(data.sent_count); 
                            $('#entry-message').load('{{trans_url('admin/message/status/Inbox')}}');
                            location.reload();
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                        }
                    });
                    e.preventDefault();
                });
            });
            </script>
