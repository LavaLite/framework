<div class="login-box">
    <div class="login-logo">
        <a href="{!! trans_url('/admin') !!}"><img src="{!!theme_asset('img/logo.svg')!!}" alt="logo" title="Lavalite"></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @include('public::notifications')
        {!! Form::vertical_open()
        ->method('POST')
        ->action('password/email')!!}
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
           <a class="text-white" href="{{trans_url("/{$guard}/login")}}">Back to Login</a> 
        </div>
    </div>
    
    <!-- /.login-box-body -->
</div>

<style type="text/css">
html {
    display: table;
    height: 100%;
    width: 100%;
}
body.login-page {
    background-color: #00b5ec;
        /* background: -webkit-linear-gradient(150.76deg,#7b94ff 0,#b288ff 47.43%,#ffb0d0 99.5%);
    background: linear-gradient(-60.76deg,#7b94ff 0,#b288ff 47.43%,#ffb0d0 99.5%); */
    display: table-cell;
    vertical-align: middle;
}
.login-box {
    width: 360px;
    margin: 0 auto;
    padding: 30px 0;
    
}
.login-box-body {
  box-shadow: 0 14px 24px 0 rgba(50,49,58,.25);
  border-radius: 6px; 
  padding: 30px;
}
.form-control-feedback {
  left: 0;
  right: auto;
  height: 40px;
}
.form-control-feedback.fa {
  line-height: 40px;
}
.has-feedback .form-control {
  padding-right: 12px;
  padding-left: 40px;
}
.form-control {
  height: 40px;
  border-radius: 3px;
}
.login-logo img {
  height: 60px;
}
.btn {
  border-radius: 3px;
  font-weight: 500;
  text-transform: uppercase;
  border: none;
  padding: 10px;
  box-shadow: 0 14px 24px 0 rgba(50,48,57,.25);
  -webkit-transition: -webkit-box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  -o-transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}
.btn:hover, .btn:focus {
  border: none !important;
}
.login-logo h3 {
  text-shadow: 0 14px 24px rgba(50,48,57,.25);
  color: #fff;
  font-size: 46px;
}
</style>