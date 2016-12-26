    <div class="head">
        <div class="overlay force-height-full">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <a class="navbar-brand" href="{{trans_url('/')}}"><img src="{{theme_asset('img/logo/white.svg')}}" alt="Lavalite" class="img-responsive"></a>
                    <ul class="nav navbar-nav  pull-right navbar-right">

                    @if(user_check())
                        <li>
                            <a href="{{ trans_url('home') }}" class="login">
                                <span class="hidden-xs">{{ users('name') }}</span>
                                <span class="hidden-sm hidden-md hidden-lg"><i class="fa fa-user"></i></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ trans_url('logout') }}" class="login">
                                <span class="hidden-xs">Logout</span>
                                <span class="hidden-sm hidden-md hidden-lg"><i class="fa fa-sign-out"></i></span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ trans_url('client') }}" class="login">
                                <span class="hidden-xs">Client</span>
                                <span class="hidden-sm hidden-md hidden-lg"><i class="fa fa-user"></i></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ trans_url('register') }}" class="login">
                                <span class="hidden-xs">Register</span>
                                <span class="hidden-sm hidden-md hidden-lg"><i class="fa fa-user"></i></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ trans_url('login') }}" class="login">
                                <span class="hidden-xs">Login</span>
                                <span class="hidden-sm hidden-md hidden-lg"><i class="fa fa-sign-in"></i></span>
                            </a>
                        </li>
                    @endif
                      </ul>
                 </div>
            </nav>
            <div class="container">
                <div class="intro-well">
                    <div class="col-md-12">
                        <h1> <small> Bootstrapper for Laravel</small> </h1>
                        <h2>Content Management System.</h2>
                        <a class="btn btn-purple btn-sm text-uppercase" href="http://www.lavalite.org/package" target="_blabk"><li class="fa fa-cubes fa-lg"></li>&nbsp;&nbsp;Packages</a>
                        <a class="btn btn-purple btn-sm text-uppercase" href="https://github.com/LavaLite/cms/wiki" target="_blabk"><li class="fa fa-book fa-lg"></li>&nbsp;&nbsp;Documentation</a>
                        <a class="btn btn-purple btn-sm text-uppercase" href="https://github.com/LavaLite/cms/archive/master.zip" target="_blabk"><li class="fa fa-download fa-lg"></li>&nbsp;&nbsp;Download</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <img src="{{ theme_asset('img/ui-screen.png') }}" alt="" class="img-responsive center-block" style="margin-top: 100px;" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="features">
        <div class="container">

            <div class="row">
                {!!Block::display('features')!!}
            </div>
        </div>
    </div>
