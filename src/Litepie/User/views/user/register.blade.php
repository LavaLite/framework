<!-- resources/views/auth/register.blade.php -->
<div class="container">
    <div class="row">
        <div class="col-md-6  col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @include('public::notifications')
                    {!!Form::vertical_open()
                    ->id('contact')
                    ->action('register')
                    ->method('POST')
                    ->class('white-row')!!}

                    {!! Form::text('name')
                    -> label(trans('user.user.label.name'))
                    -> placeholder(trans('user.user.placeholder.name'))!!}

                    {!! Form::email('email')
                    -> label(trans('user.user.label.email'))
                    -> placeholder(trans('user.user.placeholder.email'))!!}

                    {!! Form::password('password')
                    -> label(trans('user.user.label.password'))
                    -> placeholder(trans('user.user.placeholder.password'))!!}

                    {!! Form::hidden('role')->value($role)!!}

                    {!! Captcha::render() !!}
                    <br />
                    {!! Form::submit(trans('user.signin'))->class('btn btn-primary')!!}
                    <br>
                    <br>

                    {!! Form::close() !!}
                    Already have an account ! <a href="{{trans_url('/login')}}"> Click to login </a>
                </div>
            </div>
        </div>
    </div>
</div>
