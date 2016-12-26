<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">    
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{trans_url('/')}}"><img src="{{theme_asset('img/logo-white.svg')}}" alt=""></a>
        </div>
        <div class="collapse navbar-collapse">       
            
            <ul class="nav navbar-nav navbar-right">
                @if(Request::is('*login'))
                <li><a href="{{trans_url(get_guard('url')."/register")}}">Register</a></li>
                @else
                <li><a href="{{trans_url(get_guard('url')."/login")}}">Login</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>