<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
            <div class="card card-signup">
                {!!Form::vertical_open()
                ->id('contact')
                ->method('POST')!!}
                <?php $guard = ($guard == '')?'web': $guard; ?>
                    <div class="header header-primary text-center" data-background-color="red">
                        <h4>Register</h4>
                        <div class="social-line">
                            <a href="{!!trans_url($guard . '/login/facebook')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="{!!trans_url($guard . '/login/twitter')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="{!!trans_url($guard . '/login/google')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            <a href="{!!trans_url($guard . '/login/linkedin')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                    </div>  
                    <a href="{{trans_url('/')}}"><img src="{{theme_asset('img/logo-color.svg')}}" class="mt20" alt=""></a>
                    @include('public::notifications')
                    <div class="content">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">account_circle</i>
                            </span>
                            <div class="form-group is-empty label-floating">
                                <label for="name" class="control-label">Username</label>
                                {!! Form::text('name' ,'')
                                ->required()
                                ->raw()!!}
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">email</i>
                            </span>
                            <div class="form-group is-empty label-floating">
                                <label for="email" class="control-label">Email</label>
                                {!! Form::email('email', '')
                                ->required()
                                ->raw()!!}
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-group is-empty label-floating">
                                <label for="password" class="control-label">Password</label>
                                {!! Form::password('password', '')
                                ->required()
                                ->raw()!!}
                            </div>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-group label-floating">
                                <label for="password_confirmation" class="control-label">Confirm Password</label>
                                {!! Form::password('password_confirmation', '')
                                ->required()
                                ->raw()!!}
                            </div>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="optionsCheckboxes" required>
                                I agree to the <a href="#">terms and conditions</a>.
                            </label>
                        </div>
                    </div>                   
                    <div class="footer text-center mt20 mb20">
                        <button class="btn btn-raised btn-danger" type="submit">Register</button>
                     </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>