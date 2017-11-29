
<div class="row">
    <div class="col-md-12">
        <div class="panel-inbox">
            <div class="panel-body">
                <div class="inbox-mail-heading">
                    <div class="clearfix">
                        <div class="pull-left">
                            <a href="#" id="back-inbox" class="btn btn-danger btn-simple"><i class="ion-android-arrow-back"></i></a>
                            <div class="btn-group">
                                <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-archive"></i></a>
                                <a href="#" class="btn btn-danger btn-simple"><i class="ion-android-delete"></i></a>
                            </div>
                        </div>
                        <div class="pull-right">
                            <a href="#" id="draft" class="btn btn-danger btn-raised"><i class="ion-android-send visible-xs"></i><span class="hidden-xs">Draft</span></a>
                            <a href="#" id="send" class="btn btn-danger btn-raised"><i class="ion-android-send visible-xs"></i><span class="hidden-xs">Send</span></a>
                        </div>
                    </div>
                </div>
                {!!Form::vertical_open()
                ->id('create-message-message')
                ->method('POST')
                ->files('true')
                ->action(guard_url('message/message'))
                ->class('form-horizontal p15')!!}
                {!! Form::hidden('status')
                ->id('status')
                -> forceValue("Sent")!!}

                    <div class="form-group mb-md">
                        <div class="col-md-12">
                            <div class="input-icon right">
                                <a href="#" class="icon show-next-formgroup">CC</a>
                                {!! Form::select('mails[]')
                                -> id('to')
                                -> options(Message::getUsers())
                                -> addClass('js-tags select2')
                                -> style('width:100%')
                                -> multiple()
                                -> required()
                                -> raw()!!}

                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-md">
                        <div class="col-md-12">
                        {!! Form::text('subject')
                        -> placeholder("Subject for email")
                        -> required()
                        -> raw()!!}
                        </div>
                    </div>
                    <div class="form-group mb-n">
                        <div class="col-xs-12">
                            {!! Form::textarea ('message')
                            -> placeholder("Message")
                            -> required()
                            -> class('summernote')
                            -> rows(10)
                            ->cols(30)
                            -> raw()!!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $(".js-tags").select2({
          tags: true,
          placeholder: "Type email here..."
        }); 
        $('.summernote').summernote({ height: 200 });
        $('#send').click(function(){ 
            $('#create-message-message').submit();
        });

        $('#draft').click(function(){  
            if ($("#to").val() == '') {
                return;
            }
            $("#status").val('Draft');
            $('#create-message-message').submit();
        });

    $('#back-inbox').click(function(){
       $(".cur").removeClass("active");
       $('#btn-inbox').parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/status/Inbox')}}');
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
                    console.log(data);
                    $('#entry-message').load('{{guard_url('message/status/Inbox')}}');
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