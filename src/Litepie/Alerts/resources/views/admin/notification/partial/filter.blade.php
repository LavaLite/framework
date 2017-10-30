<div class="btn-group">
    <button class="btn btn-xs btn-danger btn-show-filters" type="button">
        <i aria-hidden="true" class="fa fa-search">
        </i>
        <span class="hidden-sm hidden-xs">&nbsp;Search</span>
    </button>
    <button aria-expanded="false" class="btn btn-xs btn-danger dropdown-toggle" data-toggle="dropdown" type="button">
        <span class="caret">
        </span>
        <span class="sr-only">
            Toggle Dropdown
        </span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a class="btn-show-filters" style="cursor:pointer;">
                <i aria-hidden="true" class="fa fa-fw fa-filter">
                </i>
                Show filters
            </a>
        </li>
        <li>
            <a class="reset_filter" style="cursor:pointer;">
                <i class="fa fa-fw fa-ban text-danger">
                </i>
                Clear filters
            </a>
        </li>
        <li class="divider">
        </li>
        <li>
            <a id="btn-save-popup" style="cursor:pointer;">
                <i aria-hidden="true" class="fa fa-fw fa-floppy-o">
                </i>
                Save search
            </a>
        </li>
        <li>
            <a id="btn-view-popup" style="cursor:pointer;">
                <i aria-hidden="true" class="fa fa-fw fa-folder-open-o">
                </i>
                Saved searches
            </a>
        </li>
    </ul>
</div>

<div class="modal fade" id="alerts-notification-search">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd4b39; color: #fff;">
              <button type="button" class="close" data-dismiss="modal" aaria-hidden="true">&times;</button>
              <h4 class="modal-title">Advance Search</h4>
            </div>
              {!!Form::horizontal_open()
              ->id('form-search')
              ->method('POST')
              ->action(guard_url('settings/settings'))!!}
                <div class="modal-body has-form clearfix">
                    <div class="modal-form">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 col-lg-12">
                        <button aria-label="Close" class="btn pull-right btn-danger" data-dismiss="modal" type="button">
                            <i class="fa fa-times-circle">
                            </i>
                            Close
                        </button>
                        <button class="btn btn-success pull-right " id="btn-submit-search" name="new" style="margin-right:1%" type="button">
                            <i class="fa fa-check-circle">
                            </i>
                            Search
                        </button>
                    </div>
                </div>
              {!!Form::close()!!}
        </div>
    </div>
</div>

<div class="modal fade" id="alerts-notification-search">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Save Search</h4>
      </div>
      <div class="modal-body clearfix">
        <div class="form-horizontal">
            <div class="popup_description" style="color:red;"><sup>*</sup>Type the name and save search for future use.</div>
            <div class="col-md-12 col-lg-12 m-t-20">
              {!!Form::horizontal_open()
              ->id('report_save')
              ->method('POST')
              ->files('true')
              ->action(guard_url('/save_report/save_report'))!!}


                <label for="search_name">Search Name<sup>*</sup></label><input class="form-control" placeholder="Enter Name" required="true" id="search_name" type="text" name="search_name">

              {!!Form::close()!!}  
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-alerts-notification-search" name="Saverep" value="Send">
       <i class="fa fa-check-circle"></i>&nbsp;Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">
       <i class="fa fa-times-circle"></i>&nbsp;Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="alerts-notification-saved">
  <div class="modal-dialog">
    <div class="modal-content" style="max-width:400px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Saved Searches</h4>
      </div>
      <div class="modal-body" style="height:210px; overflow-y: auto;">
        
        <div id="alerts-notification-saved-list">
          
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  name="Closerep" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$(document).ready(function(){

    $("#btn-save-popup").click(function(){
        $("#name").val('');
        $("#alerts-notification-search").modal('show');
    });

    $("#btn-view-popup").click(function(){
      $('#alerts-notification-saved-list').load("{!!guard_url('/settings/setting/list/alerts.notification.search')!!}");
      $('#alerts-notification-saved').modal("show");
    });

   $(".btn-show-filters").click(function(){
      $('#alerts-notification-search').modal("show");
    });
   
    $('#btn-alerts-notification-search').click(function(e){
        if($("#report_save").valid() == false) {
            toastr.error('Please enter valid information.', 'Error');
            return false;
        }
        var formData = new FormData();
        formData.append('value', $("#form-search").serialize());
        formData.append('name', $("#search_name").val());
        formData.append('key', 'alerts.notification.search');
        formData.append('package', 'Example');
        formData.append('module', 'Example');

        $.ajax({
            url : "{!!guard_url('/settings/setting')!!}",
            type: "POST",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(data, textStatus, jqXHR)
            {
                $('#alerts-notification-search').modal('hide');
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                toastr.error('An error occurred while saving.', 'Error');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

        e.preventDefault();
    });
    $('#btn-submit-search').click( function() {

        $('#form-search input,#form-search select').each( function () {
          oTable.search( this.value ).draw();
        });

        $('#alerts-notification-list .reset_filter').css('display', '');
        $('#alerts-notification-search').modal("hide");
        
      });

});
</script>