<div class="login-box">
  <div class="login-logo">
        <a href="{!! trans_url('/admin') !!}">{!! trans('cms.name.html') !!}</a>
  </div><!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
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
            ->action('/login')
            ->class('white-row')!!}
      <div class="form-group has-feedback">
        {!!Form::text('email')->raw()!!}
        <span class="fa fa-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {!!Form::password('password')->raw()!!}
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">

              {!! Form::checkbox('rememberme', 'Remember me &nbsp;')->inline()!!}

        </div><!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div><!-- /.col -->
      </div>
      {!! Form::hidden(config('user.params.type'))!!}
      {!!Form::Close()!!}
    <a href="{{trans_url("/password/reset?role=$guard")}}"> I forgot my password </a>
  </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
