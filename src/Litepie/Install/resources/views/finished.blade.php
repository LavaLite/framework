
        <div class="landing">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="wizard-container">
                            <div class="wizard-card" id="wizard">
                                <div class="wizard-header">
                                    <a><img src="{{theme_asset('img/logo/logo.svg')}}" class="img-responsive center-block mb10" alt=""></a>
                                    <p class="category">Lavalite Installation Wizard</p>
                                </div>
                                <div class="wizard-navigation">
                                    <div class="progress-with-circle">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 90%;"></div>
                                    </div>
                                    <ul  class="nav nav-pills">
                                        <li>
                                            <a><div class="icon-circle"><i class="pe-7s-server"></i></div>Database</a>
                                        </li>
                                        <li>
                                            <a><div class="icon-circle"><i class="pe-7s-config"></i></div>Publish</a>
                                        </li>
                                        <li>
                                            <a><div class="icon-circle"><i class="pe-7s-user"></i></div>User</a>
                                        </li>
                                        <li class="active">
                                            <a><div class="icon-circle"><i class="pe-7s-check"></i></div>Finish</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="info-text">Installation finished successfully. <br/>
                                            Click on the below links and login with the credentials given in the user setup screen.</h5>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                                        <h4>Superuser &amp; Admin</h4>
                                        <a href="{{url('/admin')}}">{{url('/admin')}}</a> <br>
                                        <h4>User</h4>
                                        <a href="{{url('/home')}}">{{url('/home')}}</a> <br>
                                        <h4>Client</h4>
                                        <a href="{{url('/client')}}">{{url('/client')}}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-footer row">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




