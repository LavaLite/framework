<!-- resources/views/auth/register.blade.php -->
<div class="wrapper-page">
    <div class="row">
        <div class="text-center">
            <a href="{{trans_url('/')}}" class="logo logo-lg"> <img src="{{theme_asset('img/logo/logo.svg')}}" class="img-responsive center-block"> </a>
        </div>
    </div>
    <hr>
    <div class="text-center">
        <h4 class="text-uppercase">Register</h4>
    </div>
    @include('public::notifications')


    {!!Form::vertical_open()
    ->id('contact')
    ->action('register')
    ->method('POST')
    ->class('white-row')!!}
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                {!! Form::text('name' ,'')
                -> placeholder(trans('user::user.user.placeholder.name'))->raw()!!}
                <i class="form-control-feedback material-icons">account_circle</i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                {!! Form::email('email', '')
                -> placeholder(trans('user::user.user.placeholder.email'))->raw()!!}
                <i class="form-control-feedback material-icons">email</i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                {!! Form::password('password', '')
                -> placeholder(trans('user::user.user.placeholder.password'))->raw()!!}
                <i class="form-control-feedback material-icons">lock</i>
            </div>
        </div>
    </div>
    @if(config('recaptcha.enable'))
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
            {!! Captcha::render() !!}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="form-group">
            <div class="col-xs-12 text-center">
                <div class="checkbox checkbox-danger">
                     {!! Form::checkbox('accept', '')->required()->inline()->raw()!!}
                    <label for="accept">
                        I accept <a href="#">Terms and Conditions</a>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-xs-12 text-center">
                <button class="btn btn-danger btn-custom w-md waves-effect waves-light" type="submit">Register</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group m-t-30">
            <div class="col-sm-12 text-center">
                <a href="{{trans_url('/login')}}" class="text-muted">Already have account?</a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="text-center social-links">
        <h3>OR<br><span class="login">Log in Using</span></h3>
        <a href="{!!trans_url($guard . '/login/facebook')!!}" class="btn btn-icon btn-primary"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="{!!trans_url($guard . '/login/twitter')!!}" class="btn btn-icon btn-info"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="{!!trans_url($guard . '/login/google')!!}" class="btn btn-icon btn-danger"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        <a href="{!!trans_url($guard . '/login/linkedin')!!}" class="btn btn-icon btn-primary"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
    </div>
</div>
