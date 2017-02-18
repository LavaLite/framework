<div class="content">
    <div class="container-fluid">
        @include('public::notifications')
        <div class="row"> 
            {!!Form::vertical_open()
            ->id('form-update-profile')
            ->method('POST')
            ->class('update-profile')!!}
            <div class="col-md-6">
                <div class="card">
                    <div class="header  header-icon" data-background-color="blue">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="content">
                        <h4 class="card-title">Update Profile</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="name">Name</label>
                                        {!! Form::text('name')
                                        -> label(trans('user::user.label.name'))
                                        -> raw()!!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="datepicker">Date of Birth</label>
                                        {!! Form::text('dob')
                                        -> label(trans('user::user.label.dob'))
                                        -> id('datepicker')
                                        -> raw()!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="designation">Designation</label>
                                        {!! Form::text('designation')
                                        -> label(trans('user::user.label.designation'))
                                        -> raw() !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="sex">Gender</label>
                                        {!! Form::radio('sex')
                                        -> radios(trans('user::user.options.sex'))
                                        -> inline() 
                                        -> raw()!!}
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="phone">Phone</label>
                                        {!! Form::number('phone')
                                        -> label(trans('user::user.label.phone'))
                                        -> raw() !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label for="mobile" class="control-label">Mobile</label>
                                        {!! Form::number('mobile')
                                        -> label(trans('user::user.label.mobile'))
                                        -> raw() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="address">Address</label>
                                        {!! Form::text('address')
                                        -> label(trans('user::user.label.address'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="street">Street</label>
                                        {!! Form::text('street')
                                        -> label(trans('user::user.label.street'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="city">City</label>
                                        {!! Form::text('city')
                                        -> label(trans('user::user.label.city'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="district">District</label>
                                        {!! Form::text('district')
                                        -> label(trans('user::user.label.district'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="state">State</label>
                                        {!! Form::text('state')
                                        -> label(trans('user::user.label.state'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="country">Country</label>
                                        {!! Form::text('country')
                                        -> label(trans('user::user.label.country'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="web">Web</label>
                                        {!! Form::text('web')
                                        -> label(trans('user::user.label.web'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    <div class="footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn-success btn-raised btn">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 mt20">
                    {!! $user->fileCropper('photo', $user->defaultImage('md','photo'))!!}
                </div>      
            </div>
            {!! Form::close() !!}

            <div class="col-md-6">
                {!!Form::vertical_open()
                ->id('contact')
                ->method('POST')
                ->class('change-password')
                ->action(getenv('guard').'/password')!!} 
                <div class="card">
                    <div class="header header-icon" data-background-color="orange">
                        <i class="material-icons">lock</i>
                    </div>
                    <div class="content">
                        <h4 class="card-title">Change Password</h4>
                            <div class="form-group label-floating">
                                <label class="control-label" for="old_password">Current Password</label>
                                {!! Form::password('old_password')
                              -> label(trans('user::user.label.current_password'))
                              -> raw() !!}
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="password">New Password</label>
                                {!! Form::password('password')
                                  -> label(trans('user::user.label.new_password'))
                                  -> raw() !!}
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="password_confirmation">Confirm New Password</label>
                                {!! Form::password('password_confirmation')
                                  -> label(trans('user::user.label.new_password_confirmation'))
                                  -> raw() !!}
                            </div>
                    </div>
                    <div class="footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn-success btn btn-raised">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        
    </div>
</div>