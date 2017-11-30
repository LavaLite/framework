<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-envelope-o"></i>
            {!! trans('message::message.name') !!}
            <small> {!! trans('app.manage') !!} {!! trans('message::message.names') !!}</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{!!guard_url('/')!!}">
                    <i class="fa fa-dashboard">
                    </i>
                    {!! trans('app.home') !!}
                </a>
            </li>
            <li class="active">
                {!! trans('message::message.names') !!}
            </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a id="compose-msg" class="btn btn-primary btn-block margin-bottom">
                    Compose
                </a>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Folders
                        </h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="cur">
                                <a id="btn-inbox">
                                    <i class="fa fa-inbox">
                                    </i>
                                    Inbox
                                    <span class="label label-primary pull-right" id="inbox_id">
                                        {!!Message::count('Inbox')!!}
                                    </span>
                                </a>
                            </li>
                            <li class="cur">
                                <a id="btn-sent">
                                    <i class="fa fa-envelope-o">
                                    </i>
                                    Sent
                                    <span class="label label-success pull-right" id="sent_id">
                                        {!!Message::count('Sent')!!}
                                    </span>
                                </a>
                            </li>                     
                            <li class="cur">
                                <a id="btn-draft">
                                    <i class="fa fa-file-text-o">
                                    </i>
                                    Drafts
                                    <span class="label label-default pull-right" id="draft_id">
                                        {!!Message::count('Draft')!!}
                                    </span>
                                </a>
                            </li>
                            <li class="cur">
                                <a id="btn-junk">
                                    <i class="fa fa-filter">
                                    </i>
                                    Junk
                                    <span class="label label-warning pull-right" id="junk_id">
                                        {!!Message::count('Junk')!!}
                                    </span>
                                </a>
                            </li>
                            <li class="cur">
                                <a id="btn-trash">
                                    <i class="fa fa-trash-o">
                                    </i>
                                    Trash
                                    <span class="label label-danger pull-right" id="trash_id">
                                        {!!Message::count('Trash')!!}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Labels
                        </h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked"> 
                            <li class="cur">
                                <a id="btn-Starred">
                                    <i class="fa fa-star text-red">
                                    </i>
                                    Starred
                                    <span class="label label-primary pull-right">
                                        {!!Message::count('Inbox', 'star')!!}
                                    </span>
                                </a>
                            </li>                  
                            
                            <li class="cur">
                                <a id="btn-Promotions">
                                    <i class="fa fa-circle-o text-yellow">
                                    </i>
                                    Promotions
                                    <span class="label label-success pull-right" id="promotions_id">
                                        {!!Message::count('Inbox', 'Promotions')!!}
                                    </span>
                                </a>
                            </li>
                            <li class="cur">
                                <a id="btn-Social">
                                    <i class="fa fa-circle-o text-light-blue">
                                    </i>
                                    Social
                                    <span class="label label-primary pull-right" id="social_id">
                                        {!!Message::count('Inbox', 'Social')!!}
                                    </span>
                                </a>
                            </li>
                            <li class="cur">
                                <a id="btn-Important">
                                    <i class="fa fa-circle-o text-red">
                                    </i>
                                    Important
                                    <span class="label label-danger pull-right" id="important_id">
                                        {!!Message::count('Inbox', 'important')!!}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-9">
                <div id='message-display'></div>
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>


    <script>
      $(function () {
        $('#compose-msg').click(function(){
            $('#message-display').load('{{guard_url('message/message/create')}}');
        });

        $('#message-display').load('{{guard_url('message/message/list/inbox')}}');
        $('#btn-inbox').parent().addClass("active");

        $('#btn-inbox').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/list/Inbox')}}');
        });

        $('#btn-sent').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/list/Sent')}}');
        });

        $('#btn-draft').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/list/Draft')}}');
        });

        $('#btn-trash').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/list/Trash')}}');
        });

        $('#btn-junk').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/list/Junk')}}');
        });

        $('#btn-Starred').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/label/starred')}}');
        });

        $('#btn-Important').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/label/important')}}');
        });

        $('#btn-Promotions').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/label/promotions')}}');
        });

        $('#btn-Social').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#message-display').load('{{guard_url('message/message/label/social')}}');
        });

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

        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          //detect type
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          //Switch states
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
        
      });
    </script>

<style type="text/css">
    a{
        cursor: pointer;
    }
    .box-header{    
        display:none;
    }
</style>

