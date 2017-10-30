<button class="btn btn-xs btn-success" id="manage-column" type="button">
    <i aria-hidden="true" class="fa fa-columns">
    </i>
    <span class="hidden-sm hidden-xs">
        Columns
    </span>
</button>
<div class="modal fade" id="manage-column-popup">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                    <i class="fa fa-times-circle">
            </i>
                </button>
                <h4 class="modal-title">
                    Manage Columns
                </h4>
            </div>
            <div class="modal-body clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col3 manage_column">
                    {!!Form::horizontal_open()
                    ->id('manage-column-form')
                    ->method('POST')
                    ->files('true')
                    ->action(guard_url('/settings/settings'))!!}

                    {!!Form::checkboxes('manage_columns')
                    ->checkboxes(trans('alerts::notification.options.manage_columns'))
                    ->inline()
                    ->raw()!!}

                    {!!Form::close()!!}
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="save_columns_settings" type="button">
                    <i class="fa fa-check-circle aria-hidden=" true""="">
                    </i>
                    Save
                </button>
                <button class="btn btn-primary" id="reset_columns_settings" type="button">
                    <i aria-hidden="true" class="fa fa-refresh">
                    </i>
                    Reset
                </button>
                <button class="btn btn-default" data-dismiss="modal" type="button">
                    <i aria-hidden="true" class="fa fa-times-circle">
                    </i>
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#manage-column').click(function(){
        $('#manage-column-popup').modal('show');
    });
    
    $('#reset_columns_settings').click(function(){
        $('.manage_column input[type=checkbox]').prop('checked', true); 
    });
  

    $('.manage_column input[type=checkbox]').change(function(){
        var column = oTable.column( $(this).attr('data-column') );
        if ($(this).prop('checked')) {
            column.visible( true );
        }else{
            column.visible( false );
        }
    });

    $("#save_columns_settings").click(function(){
        var formData = new FormData();
        formData.append('value', $('#manage-column-form').serialize());
        formData.append('key', 'alerts.notification.column');
        formData.append('package', 'Alerts');
        formData.append('module', 'Notification');
        formData.append('name', 'Alerts Notification Columns');
        $.ajax({
            url : "{!!guard_url('/settings/setting')!!}",
            type: "POST",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(data, textStatus, jqXHR)
            {
                $('#manage-column-popup').modal('hide');
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                toastr.error('An error occurred while creating.', 'Error');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

    });
</script>
<style type="text/css">
    .checkbox-inline, .radio-inline {
    min-width: 180px;
}
.checkbox-inline+.checkbox-inline, .radio-inline+.radio-inline {
    margin-left: 0px;
}
</style>