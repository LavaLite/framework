<div class="wrapper-page">
    <div class="text-center m-b-30">
        <a href="{{trans_url('/')}}" class="logo"><img src="{{theme_asset('img/logo/logo.svg')}}" class="img-responsive center-block"></a>
    </div>
    <hr>
    <div class="text-center">
        <h4 class="text-uppercase">Log In</h4>
    </div>
            <!--
@include('public::notifications')
-->
            {!!Form::vertical_open()
            ->id('login')
            ->method('POST')
            ->action('login')
            ->class('white-row')!!}
        <div class="row">
            <div class="col-xs-12">
        <div class="form-group">
                 {!! Form::email('email','')
                    -> placeholder(trans('user::user.user.placeholder.email'))->raw()!!}
                <i class="form-control-feedback material-icons">account_circle</i>
            </div>
        </div>
        </div>
        <div class="row">

            <div class="col-xs-12">
        <div class="form-group">
                {!! Form::password('password','')
                    -> placeholder(trans('user::user.user.placeholder.password'))->raw()!!}
                <i class="form-control-feedback material-icons">lock</i>
                    {!! Form::hidden(config('user.params.type'))!!}
            </div>
        </div>
        </div>
        <div class="row">

        <div class="form-group">
            <div class="col-xs-8">
                <div class="checkbox checkbox-danger">
                    {!! Form::checkbox('rememberme', '')->inline()->raw()!!}
                    <label for="rememberme">Remember me</label>
                </div>
            </div>
            <div class="col-xs-4 text-right">
                <button class="btn btn-danger btn-custom w-md waves-effect waves-light" type="submit">Log In
                </button>
            </div>
        </div>
        </div>
        <div class="row">

        <div class="form-group m-t-30">
            <div class="col-sm-7">
                <a href="{{trans_url("/password/reset?role=$guard")}}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
            </div>
            <div class="col-sm-5 text-right">
                <a href="{{trans_url("/register?role=$guard")}}" class="text-muted">Create an account</a>
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
