

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
                <a href="{{guard_url('/')}}"><img src="{{theme_asset('img/logo/logo.svg')}}" class="mt20 mb20" alt=""></a>
            <div class="card card-signup mb30">
                {!!Form::vertical_open()
                ->id('register')
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

                                {!! Form::text('name')
                                ->required()
                                ->placeholder('Name') !!}

                                {!! Form::email('email')
                                ->required()
                                ->placeholder('Email') !!}
                                {!! Form::password('password')
                                ->required()
                                ->placeholder('Password')!!}
                                {!! Form::password('password_confirmation')
                                ->required()!!}
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="optionsCheckboxes" required>
                                I agree to the <a href="#">terms and conditions</a>.
                            </label>
                        </div>
                    </div>                   
                    <div class=" text-center mt20">
                        <button type="submit" class="btn btn-raised btn-danger">Create Account</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <a href="{{guard_url("register")}}" class="mr10">Create account</a>
            <a href="{{guard_url("password/reset")}}" class="ml10">Forgot Password?</a>
        </div>
    </div>
</div>
<style type="text/css">
input[type="checkbox"]:not(:checked), input[type="checkbox"]:checked {
     position: static; 
     left: 0px; 
     opacity: 1; 
}
</style>