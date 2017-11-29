<div class="login-box">
    <div class="login-logo">
        <a href="{!! guard_url('/') !!}"><img src="{!!theme_asset('img/logo/logo.svg')!!}" alt="logo" title="Lavalite"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        @include('notifications')
        {!!Form::vertical_open()
        ->id('reset')
        ->method('POST')
        ->action(guard_url('password/reset'))!!}
        {!! csrf_field() !!}
        {!! Form::hidden('token')->value($token) !!}

        {!! Form::email('email')
        -> label(trans('user::user.label.email'))
        -> placeholder(trans('user::user.placeholder.email'))!!}

        {!! Form::password('password')
        -> label(trans('user::user.label.password'))
        -> placeholder(trans('user::user.placeholder.password'))!!}

        {!! Form::password('password_confirmation')
        -> label(trans('user::user.label.password_confirmation'))
        -> placeholder(trans('user::user.placeholder.password_confirmation'))!!}

      <button type="submit" class="btn btn-primary btn-block mt20">{{trans('user::user.reset')}}</button>

        {!! Form::close() !!}

    </div>
    <div class="row mt30">
        <div class="col-md-12 text-center">
           <a class="text-white" href="{{guard_url("login")}}">Back to Login</a> 
        </div>
    </div>
</div>
