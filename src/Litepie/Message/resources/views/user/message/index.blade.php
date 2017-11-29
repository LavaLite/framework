
<div class="content pn" style="margin: -30px -30px;">
    <div class="static-content mn">
        <div class="page-content aside-content">
            <div class="aside-wrapper">
                <div class="aside-body">
                    <div class="aside-cell aside-col">
                    <div class="aside-bar b-r">
                        <div class="aside-bar-header">
                            <div class="form-group mn">
                                <input type="text" class="form-control inbox-search-input mn" placeholder="Search mail..." name="search" id="txt-search">
                            </div>
                        </div>
                        <div class="aside-bar-body">
                            <div class="p15">
                                <a class="btn btn-block btn-raised btn-danger btn-compose" href="#" id="compose-id">Compose</a>
                            </div>
                            <ul class="acc-menu">
                                <li class="nav-separator">Folders</li>
                                <li class="cur active">
                                    <a href="#" id="btn-inbox"><span class="icon"><i class="ion-arrow-down-a"></i></span><span class="text">Inbox</span><span class="badge badge-info" id="inbox_id">{!!Message::count('Inbox')!!}</span></a>
                                </li>

                                <li class="cur">
                                    <a href="#" id="btn-draft"><span class="icon"><i class="ion-android-create"></i></span><span class="text">Drafts</span><span class="badge badge-primary" id="draft_id">{!!Message::count('draft')!!}</span></a>
                                </li>
                                <li class="cur">
                                    <a href="#" id="btn-sent"><span class="icon"><i class="ion-forward"></i></span><span class="text">Sent</span><span class="badge badge-success" id="sent_id">{!!Message::count('Sent')!!}</span></a>
                                </li>
                                <li class="cur">
                                    <a href="#" id="btn-trash"><span class="icon"><i class="ion-android-delete"></i></span><span class="text">Trash</span><span class="badge badge-danger" id="trash_id">{!!Message::count('Trash' )!!}</span></a>
                                </li>
                                <li class="nav-separator">Quick Links</li>
                                <li class="cur">
                                    <a href="#" id="btn-starred"><span class="icon"><i class="ion-stop text-warning"></i></span><span class="text">Starred</span><!-- <span class="badge badge-primary" id="star_id">{!!Message::count('star')!!}</span> --></a>
                                </li>
                                <li class="cur">
                                    <a href="#" id="btn-Important"><span class="icon"><i class="ion-stop text-danger"></i></span><span class="text">Important</span><!-- <span class="badge badge-primary" id="important_id">{!!Message::count('important' )!!}</span -->></a>
                                </li>
                                <li class="cur">
                                    <a href="#" id="btn-Promotions"><span class="icon"><i class="ion-stop text-success"></i></span><span class="text">Promotions</span><!-- <span class="badge badge-primary" id="promotions_id">{!!Message::count('Promotions')!!}</span> --></a>
                                </li>
                                <li class="cur">
                                    <a href="#" id="btn-Social"><span class="icon"><i class="ion-stop text-info"></i></span><span class="text">Social</span><!-- <span class="badge badge-primary" id="social_id">{!!Message::count('Social')!!}</span> --></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="aside-cell">
                    <div class="row">
                        <div class="col-md-12">                 
                            <div class="panel-inbox">
                                    <div class="panel-body body">
                                      <div id='entry-message'></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  $(function () {

    $("#txt-search").keyup(function(){
        var slug = $(this).val();
        if (slug == '')
            return;       
        $('#entry-message').load('{{guard_url('message/message/search')}}'+'/'+slug +'/Inbox');
    });

    $('#entry-message').load('{{guard_url('message/message/list/inbox')}}');

    $('#btn-inbox').parent().addClass("active");

    $('#compose-id').click(function(){
       $(".cur").removeClass("active");
       $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/compose')}}');
    });

    $('#btn-inbox').click(function(){
       $(".cur").removeClass("active");
       $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/list/Inbox')}}');
    });

    $('#btn-sent').click(function(){
        $(".cur").removeClass("active");
        $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/list/Sent')}}');
    });

    $('#btn-draft').click(function(){
        $(".cur").removeClass("active");
        $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/list/Draft')}}');
    });

    $('#btn-trash').click(function(){
        $(".cur").removeClass("active");
        $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/list/Trash')}}');
    });

    $('#btn-junk').click(function(){
        $(".cur").removeClass("active");
        $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/list/Junk')}}');
    });
    $('#btn-starred').click(function(){
        $(".cur").removeClass("active");
        $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/starred')}}');
    });

    $('#btn-Important').click(function(){
        $(".cur").removeClass("active");
        $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/important')}}');
    });

    $('#btn-Promotions').click(function(){
        $(".cur").removeClass("active");
        $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/list/Promotions')}}');
    });

    $('#btn-Social').click(function(){
        $(".cur").removeClass("active");
        $( this ).parent().addClass("active");
        $('#entry-message').load('{{guard_url('message/message/list/Social')}}');
    });

    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
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