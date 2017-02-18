 
 <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-danger btn-raised btn-round btn-icon">
                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                                
                                               
            </button>
            <a class="navbar-brand page-heading" href="{!!url('#')!!}">{{Theme::getTitle()}}</a>  
        </div>
        <div class="collapse navbar-collapse">            
            <ul class="nav navbar-nav navbar-left">              
                 <li  class="">
                    <a href="{{url(get_guard('url').'/calendar/calendar')}}"><span class="text">Calendar</span></a>
                </li>    
                <li  class="">
                    <a href="{{url(get_guard('url').'/task/task')}}"><span class="text">Task</span></a>
                </li>    
                  <li  class="">
                    <a href="{{url(get_guard('url').'/message/message')}}"><span class="text">Messages</span></a>
                </li>    
               
                <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <span class="icon hidden-sm hidden-xs"><i class="pe-7s-plus"></i></span>
                            <span class="text">Add</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li  class="">
                                     <a href="{{url(get_guard('url').'/news/news/create')}}"><i class="pe-7s-news-paper hidden-sm hidden-xs"></i><span>News</span></a>
                            </li>                  
                        </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown username hidden-sm hidden-xs">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="icon visible-xs"><i class="ion-android-person"></i></span>
                        <span class="text" data-localize="topnav_person">{{users('email')}}</span>
                        <span class="avatar">{!!substr(users('name'),0,1)!!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="userinfo">
                                <span class="avatar"><img class="img-responsive img-circle" src="{{users('picture')}}"></span>
                                <span class="name">{{users('name')}}</span>
                                <span class="email">{{users('email')}}</span>
                            </div>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{!!url(get_guard('url').'/message/message')!!}"><i class="pe-7s-mail"></i><span>Messages</span></a></li>             
                        <li><a href="{{url(config('auth.guard').'/profile')}}"><i class="pe-7s-tools"></i><span>Settings</span></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{url('logout')}}"><i class="pe-7s-power"></i><span>Logout</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>