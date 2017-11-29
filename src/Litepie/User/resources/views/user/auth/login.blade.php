<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
            <div class="card card-signup">
                {!!Form::vertical_open()
                ->id('login')
                ->method('POST')!!}
                    <div class="card-header header-primary text-center" data-background-color="red">
                        <h4>Sign In</h4>
                        <div class="social-line">
                            <a href="{!!guard_url('login/facebook')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="{!!guard_url('login/twitter')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="{!!guard_url('login/google')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            <a href="{!!guard_url('login/linkedin')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                    </div>  
                    <p class="text-muted mb10 mt10">Or Be Classical</p>
                    @include('notifications')
                    <div class="content">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_circle</i>
                            </span>
                            <div class="form-group label-floating">
                                <label for="username" class="control-label">Username</label>
                                {!! Form::email('email','')
                                ->required()
                                ->raw()!!}
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-group label-floating">
                                <label for="pass" class="control-label">Password</label>
                                {!! Form::password('password','')
                                ->required()
                                ->raw()!!}
                            </div>
                        </div>
                    </div>                   
                    <div class=" text-center mt20">
                        <button type="submit" class="btn btn-raised btn-danger">Login</button>
                    </div>
                {!! Form::close() !!}
                <div class="mb30 mt10">
                    <a href="{{guard_url('register')}}" class="mr10"> New? register now!</a>
                    <a href="{{guard_url('password/reset')}}"> Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
</div>