<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
        <div class="card card-signup">
            
                <div class="card-header header-primary text-center mb10" data-background-color='red'>
                    <h4>Reset Password</h4>
                    <p>Enter your Email and new password <br> to reset your password!</p>
                </div>  
                {!!Form::vertical_open()
                ->id('reset')
                ->method('POST')
                ->action(guard_url('password/reset'))!!}
                {!! csrf_field() !!}
                {!! Form::hidden('token')->value($token) !!}
                @include('notifications')
                <div class="content">                        
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">account_circle</i>
                        </span>
                        <div class="form-group label-floating">
                            <label for="email" class="control-label">Email</label>
                            {!! Form::email('email','')->raw()!!}
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
                </div>                   
                <div class="footer text-center mt20">
                    <button type="submit" class="btn btn-raised btn-danger">{{trans('user::user.reset')}}</button>
                </div>
            {!! Form::close() !!}
                <div class="mb30 mt10">
                    <a href="{{guard_url('login')}}" class="mr10"> Back to login</a>
                </div>
        </div>
        </div>
    </div>
</div>
