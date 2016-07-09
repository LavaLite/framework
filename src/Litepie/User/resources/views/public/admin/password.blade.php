<div class="login-box">
    <div class="login-logo">
        <a href="{!! trans_url('/admin') !!}">{!! trans('cms.name.html') !!}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        @include('public::notifications')
        {!!
        Form::vertical_open()
        -> action('password/email')
        !!}
        {!! csrf_field() !!}
        @if (Session::has('status'))
        <div class="alert alert-info">
            <strong>Info!</strong> {!!  Session::pull('status'); !!}
        </div>
        @else
        If you have forgotten your password - reset it.
        <br />
        <br />
        @endif
        <div class="form-group has-feedback">
            {!!Form::text('email', '')!!}
            <span class="fa fa-envelope form-control-feedback"></span>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-xs-6">
              {!! Form::hidden(config('user.params.type'))!!}
                <button type="submit" class="btn btn-primary btn-block btn-flat">Send password</button>
            </div>
            <!-- /.col -->
        </div>
        {!!Form::Close()!!}
        <a href="{{trans_url("/login?role=$guard")}}">Back to login</a><br>
    </div>
    <!-- /.login-box-body -->
</div>
