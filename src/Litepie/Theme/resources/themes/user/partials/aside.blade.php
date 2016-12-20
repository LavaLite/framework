                @if(getenv('auth.guard') == 'user')
                    <div class="logo">
                        <a href="{!!url('home')!!}" class="logo-image">
                            <img src="{!!url('img/logo-white.svg')!!}" alt="logo" title="Lavalite">
                        </a>
                    </div>
                    <div class="logo logo-mini">
                        <a href="{!!url('home')!!}" class="logo-image">
                            <img src="{!!url('img/logo.svg')!!}" alt="logo-mini" title="Lavalite">
                        </a>
                    </div>
                @else
                    <div class="logo">
                        <a href="{!!url(getenv('auth.guard'))!!}" class="logo-image">
                            <img src="{!!url('img/logo-white.svg')!!}" alt="logo" title="Lavalite">
                        </a>
                    </div>
                    <div class="logo logo-mini">
                        <a href="{!!url(getenv('auth.guard'))!!}" class="logo-image">
                            <img src="{!!url('img/logo.svg')!!}" alt="logo-mini" title="Lavalite">
                        </a>
                    </div>
                @endif 
                

                <div class="sidebar-wrapper">
                    <div class="user">
                        <div class="photo">
                            <img src="{{users('picture')}}" class="img-responsive img-circle" alt="user">                           
                        </div>
                        <div class="info">
                            <h3>{{users('name')}}</h3>
                        </div>
                        <div class="user-links">
                            <a href="{{url(config('auth.guard').'/profile')}}"><i class="pe-7s-tools"></i><span>Settings</span></a>
                            <a href="{{url('logout')}}"><i class="pe-7s-power"></i><span>Log Out</span></a>
                        </div>
                    </div>

                
                    @if(getenv('auth.guard') == 'user')
                        {!!Menu::menu('user-aside')!!}
                    @elseif(getenv('auth.guard') == 'client')
                        {!!Menu::menu('client-aside')!!}
                    @endif    
                </div>
                <div class="sidebar-background" style="display: block;"></div>



