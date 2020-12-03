{!!Form::vertical_open()
        ->id('install-db')
        ->method('POST')
        ->files('true')
        ->action('')!!}
<div class="landing">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="wizard-container">
                    <div class="wizard-card" id="wizard">
                        <div class="wizard-header">
                            <a>
                                <img alt="" class="img-responsive center-block mb10" src="{{asset('img/logo/logo.svg')}}"/>
                            </a>
                            <p class="category">
                                Lavalite Installation Wizard
                            </p>
                        </div>
                        <div class="wizard-navigation">
                            <div class="progress-with-circle">
                                <div aria-valuemax="4" aria-valuemin="1" aria-valuenow="1" class="progress-bar" role="progressbar" style="width: 66.6%;">
                                </div>
                            </div>
                            <ul class="nav nav-pills">
                                <li>
                                    <a>
                                        <div class="icon-circle">
                                            <i class="pe-7s-server">
                                            </i>
                                        </div>
                                        Database
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div class="icon-circle">
                                            <i class="pe-7s-config">
                                            </i>
                                        </div>
                                        Publish
                                    </a>
                                </li>
                                <li  class="active">
                                    <a>
                                        <div class="icon-circle">
                                            <i class="pe-7s-user">
                                            </i>
                                        </div>
                                        User
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div class="icon-circle">
                                            <i class="pe-7s-check">
                                            </i>
                                        </div>
                                        Finish
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5 class="info-text">
                                        Set login credentials for all users in the application.
                                    </h5>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-sm-12">
                                        @include('public::notifications')
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        Superuser
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!!Form::email('user[superuser][email]')->required()->placeholder('email')->raw()!!}
                                    </div>
                                    <div class="col-sm-6">
                                        {!!Form::password('user[superuser][password]')->required()->placeholder('password')->raw()!!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        Admin
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!!Form::email('user[admin][email]')->required()->placeholder('email')->raw()!!}
                                    </div>
                                    <div class="col-sm-6">
                                        {!!Form::password('user[admin][password]')->required()->placeholder('password')->raw()!!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        User
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!!Form::email('user[user][email]')->required()->placeholder('email')->raw()!!}
                                    </div>
                                    <div class="col-sm-6">
                                        {!!Form::password('user[user][password]')->required()->placeholder('password')->raw()!!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        Client
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!!Form::email('user[client][email]')->required()->placeholder('email')->raw()!!}
                                    </div>
                                    <div class="col-sm-6">
                                        {!!Form::password('user[client][password]')->required()->placeholder('password')->raw()!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button class="btn btn-danger" type="submit">
                                        Add Users
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
