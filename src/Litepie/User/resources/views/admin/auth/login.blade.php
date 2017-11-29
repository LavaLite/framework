<div class="login-box">
  <div class="login-logo">
        <a href="{!! guard_url('/') !!}"><img src="{!!theme_asset('img/logo/logo.svg')!!}" alt="logo" title="Lavalite"><!-- <h3>Lavalite</h3> --></a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    @include('notifications')
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
          <a href="{{guard_url("password/reset")}}"> Forgot Password?</a>
        </div><!-- /.col -->
      </div>
      <button type="submit" class="btn btn-primary btn-block mt20">Sign In</button>
      {!!Form::Close()!!}
    
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

