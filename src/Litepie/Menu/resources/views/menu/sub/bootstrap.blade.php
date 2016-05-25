<ul class="dropdown-menu animated fadeIn" role="menu">
    @foreach ($menus as $menu)
        @if ($children = $menu->getChildren())
        <li class="{{ ($menu->active) ?  'active' : '' }}"  role="button" class="dropdown-toggle" data-toggle="dropdown">
            <a href="{{URL::to($menu->url)}}" >
                <i class="{{{ !empty($menu->icon) ?  $menu->icon : '' }}}"></i> <span>{{$menu->name}}</span>
                <b class="caret"></b>
            </a>
            @include('menu::menu.sub.bootstrap', array('menus' => $children))
        </li>
        @else
        <li  {{ isset($menu->active) ?  'class="active"' : '' }}>
            <a href="{{URL::to($menu->url)}}">
                <i class="{{{ !empty($menu->icon) ?  $menu->icon : '' }}}"></i>
                {{$menu->name}}
            </a>
        </li>
        @endif
    @endforeach
</ul>
