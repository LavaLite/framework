<button class="btn btn-xs btn-success" id="manage-column" type="button">
    <i aria-hidden="true" class="fa fa-columns">
    </i>
    <span class="hidden-sm hidden-xs">
        Columns
    </span>
</button>
<div class="modal fade" id="modal-manage-column">
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col3 manage-column">
                    {!!Form::horizontal_open()
                    ->id('form-manage-column')
                    ->method('POST')
                    ->files('true')
                    ->action(guard_url('/settings/settings'))!!}

                    {!!Form::checkboxes('manage_columns')
                    ->checkboxes(trans('user::user.cloumns'))
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
                <button class="btn btn-primary" id="btn-reset-column" type="button">
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
        $('#modal-manage-column').modal('show');
    });
    
    $('#btn-reset-column').click(function(){
        $('#form-manage-column')[0].reset(); 

        $('#form-manage-column input[type=checkbox]').each( function () {
            var column = oTable.api().column( $(this).attr('data-column') );
            console.log($(this).attr('data-column'));
            if ($(this).prop('checked')) {
                column.visible( true );
            }else{
                column.visible( false );
            }
        });
    });
  

    $('.manage-column input[type=checkbox]').change(function(){
        var column = oTable.api().column( $(this).attr('data-column') );
        if ($(this).prop('checked')) {
            column.visible( true );
        }else{
            column.visible( false );
        }
    });

    $("#save_columns_settings").click(function(){
        toastr.info('This feature will be enabled soon.', 'Coming soon');
        $('#modal-manage-column').modal('hide');
        return false;
        var formData = new FormData();
        formData.append('value', $('#form-manage-column').serialize());
        formData.append('key', 'user.user.column');
        formData.append('package', 'User');
        formData.append('module', 'User');
        formData.append('name', 'Column');
        $.ajax({
            url : "{!!guard_url('/settings/setting')!!}",
            type: "POST",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(data, textStatus, jqXHR)
            {
                $('#modal-manage-column').modal('hide');
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