<div class="login-box">
    <div class="login-logo">
        <a href="{!! guard_url('/') !!}"><img src="{!!theme_asset('img/logo/logo.svg')!!}" alt="logo" title="Lavalite"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @include('notifications')
        {!! Form::vertical_open()
        ->method('POST')
        ->action(guard_url('password/email'))!!}
        {!! csrf_field() !!}
        @if (Session::has('status'))
        <div class="alert alert-info">
            <strong>Info!</strong> {!!  Session::pull('status'); !!}
        </div>
        @else
        <p>If you have forgotten your password - reset it.</p>
        @endif
        <div class="form-group has-feedback mt20">
            {!!Form::text('email', '')!!}
            <span class="fa fa-envelope form-control-feedback"></span>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Send password</button>
        {!!Form::Close()!!}
        
    </div>
    <div class="row mt30">
        <div class="col-md-12 text-center">
           <a class="text-white" href="{{guard_url("login")}}">Back to Login</a> 
        </div>
    </div>
    
    <!-- /.login-box-body -->
</div>
