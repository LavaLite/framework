        <div class="container page-container">
            <div class="page-content">
                <div class="card card-signup">
                        {!!Form::vertical_open()
                        ->id('contact')
                        ->method('POST')!!}
                        <?php $guard = ($guard == '')?'web': $guard; ?>
                        <div class="header header-primary text-center">
                            <h4>Register</h4>                            
                            <div class="social-line">
                                <a href="{!!trans_url($guard . '/login/facebook')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="{!!trans_url($guard . '/login/twitter')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="{!!trans_url($guard . '/login/google')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a href="{!!trans_url($guard . '/login/linkedin')!!}" class="btn btn-simple btn-just-icon"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </div>
                        </div>                         
                        <p class="text-divider mb10">Or Be Classical</p>
                        @include('public::notifications')
                        <div class="content">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">account_circle</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label for="username" class="control-label">Username</label>
                                    {!! Form::text('name' ,'')->raw()!!}
                                </div>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">mail</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label for="username" class="control-label">Email</label>
                                    {!! Form::email('email', '')->raw()!!}
                                </div>
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label for="username" class="control-label">Password</label>
                                    {!! Form::password('password', '')->raw()!!}
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-group label-floating">
                                    <label for="username" class="control-label">Confirm Password</label>
                                    {!! Form::password('password_confirmation', '')->raw()!!}
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="optionsCheckboxes" required>
                                    I agree to the <a href="#">terms and conditions</a>.
                                </label>
                            </div>
                        </div> 

                        <div class="footer text-center mt20">
                            <button type="submit" class="btn btn-raised btn-danger">Register Now</button>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
