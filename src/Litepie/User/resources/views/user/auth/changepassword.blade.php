@include('public::notifications')
<div class="dashboard-content">
<div class="panel panel-color panel-inverse">
    <div class="heading">
        <h3 class="panel-title">
            Change 
            <span>
                password
            </span>
        </h3>
        <p class="panel-sub-title m-t-5 text-muted">
            Change password for {{ users('name') }}
        </p>
    </div>
    <div class="body">
      {!!Form::vertical_open()
      ->id('contact')
      ->method('POST')
      ->class('change-password')!!}

      {!! Form::password('old_password')
      -> label(trans('user::user.label.current_password'))
      -> placeholder(trans('user::user.placeholder.current_password'))!!}

      {!! Form::password('password')
      -> label(trans('user::user.label.new_password'))
      -> placeholder(trans('user::user.placeholder.new_password'))!!}


      {!! Form::password('password_confirmation')
      -> label(trans('user::user.label.new_password_confirmation'))
      -> placeholder(trans('user::user.placeholder.new_password_confirmation'))!!}

      {!! Form::submit(trans('user::user.changepassword'))->class('btn btn-primary')!!}
      <br>
      <br>

      {!! Form::close() !!}
    </div>
</div>
</div>
