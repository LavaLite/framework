<div class="content-wrapper" style="min-height: 1096px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!!url('admin')!!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Profile</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-warning">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{!!user('admin.web')->picture!!}" alt="User profile picture">
                        <h3 class="profile-username text-center">{!!user('admin.web')->name!!}</h3>
                        <p class="text-muted text-center">{!!user('admin.web')->designation!!} - Member Since {!!user('admin.web')->joined!!}</p>
                        <button  class="btn btn-primary btn-block"  id="update-profile"><b>Update Profile</b></button>
                        <button  class="btn btn-warning btn-block" id="change-password"><b>Change Password</b></button>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- About Me Box -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me <small> Customize this widget</small></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i>  Education</strong>
                        <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>a
                        <hr>
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
                        <p class="text-muted">Malibu, California</p>
                        <hr>
                        <strong><i class="fa fa-pencil margin-r-5"></i> Projects</strong>
                        <p>
                        <span class="label label-danger">UI Design</span>
                        <span class="label label-success">Coding</span>
                        <span class="label label-info">Javascript</span>
                        <span class="label label-warning">PHP</span>
                        <span class="label label-primary">Node.js</span>
                        </p>
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div id="show-home">
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tasks" data-toggle="tab" aria-expanded="false">Task</a></li>
                            <li class=""><a href="#calendars" data-toggle="tab" aria-expanded="false">Calendar</a></li>
                            <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Settings</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tasks">
                                {!! @Task::display('profile') !!}
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="calendars">
                                {!! @Calendar::display('profile') !!}
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="settings">
                                {!! @Settings::display('setting') !!}
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
            
            <div id="show-profile">
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#profile" data-toggle="tab" aria-expanded="false">Profile</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                @include('public::notifications')
                                {!!@ User::profile('edit', 'admin.web') !!}
                                <button type="button" class="btn btn-primary" id="btn-update-profile">Save changes</button>
                                <button type="button" class="btn btn-default btn-close">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="show-change-password">
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#change-pwd" data-toggle="tab" aria-expanded="false">Change Password</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="change-pwd">
                                {!!@ User::password('change', 'admin.web') !!}
                                <button type="button" class="btn btn-primary" id="btn-change-password">Save changes</button>
                                <button type="button" class="btn btn-default btn-close">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>


<script type="text/javascript">
(function ($) {

    $('#show-home').hide();
    $('#show-profile').show();
    $('#show-change-password').hide();
    $('#update-profile').click(function(){
        $('#show-home').hide();
        $('#show-change-password').hide();
        $('#show-profile').show();
    });

    $('#change-password').click(function(){
        $('#show-home').hide();
        $('#show-profile').hide();
        $('#show-change-password').show();
    });

    $('.btn-close').click(function(){
        $('#show-profile').hide();
        $('#show-change-password').hide();
        $('#show-home').show();
    });

    $('#btn-change-password').click(function(){
        $('#form-change-password').submit();
    });

    $('#form-change-password')
    .submit( function( e ) {
        if($('#form-change-password').valid() == false) {
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
            },
            success:function(data, textStatus, jqXHR)
            {
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });
        e.preventDefault();
    });

    $('#btn-update-profile').click(function(){
        $('#form-update-profile').submit();
    });

    $('#form-update-profile')
    .submit( function( e ) {
        if($('#form-update-profile').valid() == false) {
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
            },
            success:function(data, textStatus, jqXHR)
            {
                 location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            }
        });
        e.preventDefault();
    });
}(jQuery));
</script>
