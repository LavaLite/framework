
    <div class="card-box widget-user m-b-0">
        <div class="clearfix m-b-20">
            <img src="{{users('picture')}}" class="img-responsive img-circle" alt="user">
            <div class="wid-u-info">
                <h4 class="m-t-0 m-b-5">{{users('name')}}</h4>
                <p class="text-muted m-b-5 font-13">{{users('designation')}}</p>
                <small class="text-warning">{{users('dob')}}</small>
            </div>
        </div>
        <div class="user-links">
            <a href="{{url(config('auth.guard').'/profile')}}"><i class="fa fa-user fa-fw"></i>{{trans('app.profile')}}</a> 
            <a href="{{url(config('auth.guard').'/password')}}"><i class="fa fa-key fa-fw"></i>{{trans('app.password')}}</a> 
            <a href="{{url('logout')}}"><i class="fa fa-sign-out fa-fw"></i>{{trans('app.logout')}}</a>
        </div>
    </div>
    <div class="dashboard-side-nav m-t-5">
        <ul>
            <li class="{{Request::is('*home*') ? 'active' : ''}}"><a href="{{ trans_url('home') }}"><i class="icon-game-controller"></i><span>Dashboard</span></a></li>
            {!!Menu::menu('user')!!}
        </ul>
    </div>
