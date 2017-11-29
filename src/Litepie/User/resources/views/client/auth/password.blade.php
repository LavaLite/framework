

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
                <a href="{{guard_url('/')}}"><img src="{{theme_asset('img/logo/logo.svg')}}" class="mt20 mb20" alt=""></a>
            <div class="card card-signup mb30">
                {!!Form::vertical_open()
                ->id('reset')
                ->action(guard_url('password/email'))
                ->method('POST')!!}
                    <div class="header header-primary text-center" data-background-color="red">
                        <h2>Forgot Password</h2>
                        @include('notifications')

                    </div>  
                    <div class="content mt20 text-left">
                                {!! Form::email('email')
                                ->required()!!}
                    </div>                   
                    <div class=" text-center mt20">
                        <button type="submit" class="btn btn-raised btn-danger">Reset Password</button>
                    </div>
                {!! Form::close() !!}
            </div>
            <a href="{{guard_url("login")}}" class="mr10">Back to login</a>
        </div>
    </div>
</div>