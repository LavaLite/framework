<div class="wrapper-page">
    <div class="text-center m-b-30">
        <a href="{{trans_url('/')}}" class="logo"><img src="{{theme_asset('img/logo/logo.svg')}}" class="img-responsive center-block"></a>
    </div>
        {!!Form::vertical_open()
        ->method('POST')
        ->action('password/email')!!}
        {!! csrf_field() !!}
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Enter your <b>Email</b> and instructions will be sent to you!
        </div>
        <div class="form-group m-b-0">
            <div class="input-group">
                {!!Form::text('email' , '')
                -> placeholder(trans('user::user.user.placeholder.email'))->raw()!!}
                <span class="input-group-btn"> <button type="submit" class="btn btn-email btn-danger waves-effect waves-light" style="height: 40px;">Reset</button> </span>{!! Form::hidden(config('user.params.type'))!!}
            </div>
        </div>
        <div class="form-group m-t-30">
            <div class="col-sm-7">
                <a href="{{trans_url("/login?role=$guard")}}" class="text-muted"><i class="fa fa-lock m-r-5"></i> Back to login</a>
            </div>
        </div>
        {!! Form::close() !!}
</div>
