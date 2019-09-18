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
                                        <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4" style="width: 33.3%;"></div>
                                    </div>
                                    <ul  class="nav nav-pills">
                                        <li>
                                            <a><div class="icon-circle"><i class="pe-7s-server"></i></div>Database</a>
                                        </li>
                                        <li class="active">
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
                                            <h5 class="info-text">Publish config, assets, public files, language files, default theme, migratins and seeds for lavalite and litepie packages.</h5>
                                        </div>



                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1"  name='config' checked readonly>
                                                    Publish configuration files?
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1"  name='seeds' checked readonly>
                                                    Publish migration and seeds?
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1"  name='view' checked>
                                                    Publish view files?
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1"  name='public' checked>
                                                    Publish public assets ?
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="1"  name='lang' checked>
                                                    Publish language files?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-footer row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-danger">Publish Files</button>
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




