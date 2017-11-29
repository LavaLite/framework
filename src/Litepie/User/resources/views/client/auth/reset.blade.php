
<div class="container page-container">
    <div class="page-content">
        <div class="card card-signup">
            
                {!!Form::vertical_open()
                ->id('reset')
                ->method('POST')
                ->action(guard_url('password'))
                !!}
                {!! csrf_field() !!}
                {!! Form::hidden('token')->value($token) !!}
                <div class="header header-primary text-center mb10">
                    <h4>Forgot Password</h4>
                    <p>Enter your Email and instructions <br> will be sent to you!</p>
                </div>  
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
        </div>
    </div>
</div>
