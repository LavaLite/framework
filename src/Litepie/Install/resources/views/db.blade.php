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
                                    <a><img src="{{asset('img/logo/logo.svg')}}" class="img-responsive center-block mb10" alt=""></a>
                                    <p class="category">Lavalite Installation Wizard</p>
                                </div>
                                <div class="wizard-navigation">
                                    <div class="progress-with-circle">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 15%;"></div>
                                    </div>
                                    <ul  class="nav nav-pills">
                                        <li class="active">
                                            <a><div class="icon-circle"><i class="pe-7s-server"></i></div>Database</a>
                                        </li>
                                        <li>
                                            <a><div class="icon-circle"><i class="pe-7s-config"></i></div>Publish</a>
                                        </li>
                                        <li>
                                            <a><div class="icon-circle"><i class="pe-7s-user"></i></div>User</a>
                                        </li>
                                        <li>
                                            <a><div class="icon-circle"><i class="pe-7s-check"></i></div>Finish</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="info-text">Below you should enter your database connection details.</h5>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="database_name">Database Name</label>
                                                {!!Form::text('database')->required()->raw()!!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label  class="control-label" for="user_name">User Name</label>
                                                {!!Form::text('user')->required()->raw()!!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label  class="control-label" for="password">Password</label>
                                                {!!Form::text('password')->required()->raw()!!}
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label  class="control-label" for="database_host">Database Host</label>
                                                {!!Form::text('host')->value('127.0.0.1')->required()->raw()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-footer row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-danger">Update Config</button>
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
