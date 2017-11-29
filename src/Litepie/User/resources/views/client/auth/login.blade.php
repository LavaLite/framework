<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
                <a href="{{guard_url('/')}}"><img src="{{theme_asset('img/logo/logo.svg')}}" class="mt20 mb20" alt=""></a>
            <div class="card card-signup mb30">
                {!!Form::vertical_open()
                ->id('login')
                ->method('POST')!!}
                    <div class="header header-primary text-center" data-background-color="red">
                        <h2>Sign In</h2>
                        @include('notifications')
                        <div class="social-line">
                            <a href="{!!guard_url('login/facebook')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="{!!guard_url('login/twitter')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="{!!guard_url('login/google')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            <a href="{!!guard_url('login/linkedin')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                    </div>  
                    <div class="content mt20 text-left">


                                {!! Form::email('email')
                                ->required()
                                ->placeholder('Email') !!}
                                {!! Form::password('password')
                                ->required()
                                ->placeholder('Password')!!}

                    </div>                   
                    <div class=" text-center mt20">
                        <button type="submit" class="btn btn-raised btn-danger">Login</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <a href="{{guard_url("register")}}" class="mr10">Create account</a>
            <a href="{{guard_url("password/reset")}}" class="ml10">Forgot Password?</a>
        </div>
    </div>
</div>