<div class="wrapper-page">
    <div class="text-center m-b-30">
        <a href="{{trans_url('/')}}" class="logo"><img src="{{theme_asset('img/logo/logo.svg')}}" class="img-responsive center-block"></a>
    </div>
    <hr>
    <div class="text-center">
        <h4 class="text-uppercase">Reset your password</h4>
    </div>
    {!!Form::vertical_open()
    ->id('reset')
    ->method('POST')
    ->action('/password/reset')!!}
    {!! csrf_field() !!}
    {!! Form::hidden('token')->value($token) !!}
    {!! Form::hidden(config('user.params.type'))!!}
@include('public::notifications')

    <div class="row">
        <div class="form-group">
            <div class="col-xs-12">
                {!! Form::email('email', '')
                -> placeholder(trans('user::user.user.placeholder.email'))!!}
                <i class="form-control-feedback material-icons">email</i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-xs-12">
                {!! Form::password('password', '')
                -> placeholder(trans('user::user.user.placeholder.password'))!!}
                <i class="form-control-feedback material-icons">lock</i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-xs-12">
                {!! Form::password('password_confirmation', '')
                -> placeholder(trans('user::user.user.placeholder.password_confirmation'))!!}
                <i class="form-control-feedback material-icons">lock</i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class="col-xs-12 text-right">
                <button class="btn btn-danger btn-custom w-md waves-effect waves-light" type="submit">{{trans('user::user.reset')}}</button>
            </div>
        </div>
    </div>



    {!! Form::close() !!}
</div>
