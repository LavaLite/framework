@extends('admin::general.default')
@section('heading')

@stop
@section('title')
{!! trans('message::message.names') !!}
@stop
@section('breadcrumb')
<ol class="breadcrumb">
    <li>
        <a href="{!!URL::to('admin')!!}">
            <i class="fa fa-dashboard">
            </i>
            {!! trans('app.home') !!}
        </a>
    </li>
    <li class="active">
        {!! trans('message::message.names') !!}
    </li>
</ol>
@stop
@section('entry')
@stop
@section('tools')
@stop
@section('content')
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
                                {!!Message::adminMsgcount('Inbox')!!}
                            </span>
                        </a>
                    </li>
                    <li class="cur">
                        <a id="btn-sent">
                            <i class="fa fa-envelope-o">
                            </i>
                            Sent
                            <span class="label label-success pull-right" id="sent_id">
                                {!!Message::adminMsgcount('Sent')!!}
                            </span>
                        </a>
                    </li>                     
                    <li class="cur">
                        <a id="btn-draft">
                            <i class="fa fa-file-text-o">
                            </i>
                            Drafts
                            <span class="label label-default pull-right" id="draft_id">
                                {!!Message::adminMsgcount('Draft')!!}
                            </span>
                        </a>
                    </li>
                    <li class="cur">
                        <a id="btn-junk">
                            <i class="fa fa-filter">
                            </i>
                            Junk
                            <span class="label label-warning pull-right" id="junk_id">
                                {!!Message::adminMsgcount('Junk')!!}
                            </span>
                        </a>
                    </li>
                    <li class="cur">
                        <a id="btn-trash">
                            <i class="fa fa-trash-o">
                            </i>
                            Trash
                            <span class="label label-danger pull-right" id="trash_id">
                                {!!Message::adminMsgcount('Trash')!!}
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
                           <!--  <span class="label label-primary pull-right">
                                {!!Message::adminSpecialcount('star')!!}
                            </span> -->
                        </a>
                    </li>                  
                    
                    <li class="cur">
                        <a id="btn-Promotions">
                            <i class="fa fa-circle-o text-yellow">
                            </i>
                            Promotions
                            <!-- <span class="label label-success pull-right" id="promotions_id">
                                {!!Message::adminMsgcount('Promotions')!!}
                            </span> -->
                        </a>
                    </li>
                    <li class="cur">
                        <a id="btn-Social">
                            <i class="fa fa-circle-o text-light-blue">
                            </i>
                            Social
                            <!-- <span class="label label-primary pull-right" id="social_id">
                                {!!Message::adminMsgcount('Social')!!}
                            </span> -->
                        </a>
                    </li>
                    <li class="cur">
                        <a id="btn-Important">
                            <i class="fa fa-circle-o text-red">
                            </i>
                            Important
                            <!-- <span class="label label-danger pull-right" id="important_id">
                                {!!Message::adminSpecialcount('important')!!}
                            </span> -->
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
        <div id='entry-message'></div>
    </div>
    <!-- /.col -->
</div>

@stop
@section('script')
    <link rel="stylesheet" type="text/css" href="https://select2.github.io/dist/css/select2.min.css">
    <script type="text/javascript" src="https://select2.github.io/dist/js/select2.full.js"></script>
    <script>
      $(function () {

        $(".js-example-tags").select2({
          tags: true
        });

        $('#compose-msg').click(function(){
            $('#entry-message').load('{{URL::to('admin/message/compose')}}');
        });

        $('#entry-message').load('{{URL::to('admin/message/status/Inbox')}}');
         $('#btn-inbox').parent().addClass("active");
        $('#btn-inbox').click(function(){
           $(".cur").removeClass("active");
           $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/status/Inbox')}}');
        });

        $('#btn-sent').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/status/Sent')}}');
        });

        $('#btn-draft').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/status/Draft')}}');
        });

        $('#btn-trash').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/status/Trash')}}');
        });

        $('#btn-junk').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/status/Junk')}}');
        });

        $('#btn-Starred').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/starred')}}');
        });

        $('#btn-Important').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/important_msg')}}');
        });

        $('#btn-Promotions').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/status/Promotions')}}');
        });

        $('#btn-Social').click(function(){
            $(".cur").removeClass("active");
            $( this ).parent().addClass("active");
            $('#entry-message').load('{{URL::to('admin/message/status/Social')}}');
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
@stop
@section('style')
<style type="text/css">
    a{
        cursor: pointer;
    }
    .box-header{    display:none;
    }
</style>
@stop
