<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
            <div class="card card-signup">
                {!!Form::vertical_open()
                ->method('POST')
                ->action('password/email')!!}
                {!! csrf_field() !!}
                {!! Form::hidden(config('litepie.user.params.type'))!!}
                    <div class="header header-primary text-center" data-background-color="red">
                        <h4>Forgot Password</h4>
                    </div>  
                    <a href="{{trans_url('/')}}"><img src="{{theme_asset('img/logo-color.svg')}}" class="mt20" alt=""></a>
                    <p class="text-muted mb10 mt10">Enter your Email and instructions <br> will be sent to you!</p>
                    @include('public::notifications')
                    <div class="content">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">mail</i>
                            </span>
                            <div class="form-group is-empty label-floating">
                                <label for="username" class="control-label">Email</label>
                                {!! Form::email('email','')
                                ->required()
                                ->raw()!!}
                            </div>
                        </div>
                    </div>                   
                    <div class="footer text-center mt20">
                        <button type="submit" class="btn btn-raised btn-danger">Reset Password</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>