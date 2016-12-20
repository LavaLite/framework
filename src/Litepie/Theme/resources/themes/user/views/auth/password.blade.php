<div class="container page-container">
    <div class="page-content">
        
        <div class="card card-signup">                
                {!!Form::vertical_open()
                ->method('POST')
                ->action('password/email')!!}
                {!! csrf_field() !!}
                {!! Form::hidden(config('litepie.user.params.type'))!!}
                <div class="header header-primary text-center mb10">
                    <h4>Forgot Password</h4>
                    <p>Enter your Email and instructions <br> will be sent to you!</p>
                </div>  
                @include('public::notifications')                
                <div class="content"> 
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">mail</i>
                        </span>
                        <div class="form-group is-empty label-floating">
                            <label for="username" class="control-label">Email</label>
                            {!! Form::email('email','')->raw()!!}
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