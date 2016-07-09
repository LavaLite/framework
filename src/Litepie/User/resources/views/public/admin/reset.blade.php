<div class="login-box">
    <div class="login-logo">
        <a href="{!! trans_url('/admin') !!}">{!! trans('cms.name.html') !!}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">

        @include('public::notifications')
        Reset <small>Password</small>
        {!!Form::vertical_open()
        ->id('reset')
        ->method('POST')
        ->action('/password/reset')!!}
        {!! csrf_field() !!}
        {!! Form::hidden('token')->value($token) !!}
        {!! Form::hidden(config('user.params.type'))!!}

        {!! Form::email('email')
        -> label(trans('user::user.user.label.email'))
        -> placeholder(trans('user::user.user.placeholder.email'))!!}

        {!! Form::password('password')
        -> label(trans('user::user.user.label.password'))
        -> placeholder(trans('user::user.user.placeholder.password'))!!}

        {!! Form::password('password_confirmation')
        -> label(trans('user::user.user.label.password_confirmation'))
        -> placeholder(trans('user::user.user.placeholder.password_confirmation'))!!}

        {!! Form::submit(trans('user::user.reset'))!!}

        {!! Form::close() !!}

    </div>
</div>
