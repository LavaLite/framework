<div class="login-box">
  <div class="login-logo">
        <a href="{!! trans_url('/admin') !!}"><img src="{!!theme_asset('img/logo.svg')!!}" alt="logo" title="Lavalite"><!-- <h3>Lavalite</h3> --></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
@if (count($errors) > 0)
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                - {{ $error }}<br/>
            @endforeach
    </div>
@endif
    {!!Form::vertical_open()
            ->id('login')
            ->method('POST')
            ->class('white-row')!!}
      <div class="form-group has-feedback">
        {!!Form::text('email')->placeholder('Username')->raw()!!}
        <span class="fa fa-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {!!Form::password('password')->placeholder('Password')->raw()!!}
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="checkbox mtn">
            <input id="rememberme" type="checkbox" name="rememberme">
            <label for="rememberme">Remember Me</label>
          </div>
        </div>
        <div class="col-xs-6 text-right">
          <a href="{{trans_url("/$guard/password/reset")}}"> Forgot Password?</a>
        </div><!-- /.col -->
      </div>
      <button type="submit" class="btn btn-primary btn-block mt20">Sign In</button>
      {!!Form::Close()!!}
    
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
<style>
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
