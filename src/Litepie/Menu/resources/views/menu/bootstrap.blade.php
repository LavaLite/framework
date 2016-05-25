<ul class="nav nav-pills pull-right">
    @foreach ($menus as $menu)
        @if ($children = $menu->getChildren())
        <li class="{{ $menu->active or '' }}"  role="button" class="dropdown-toggle" data-toggle="dropdown">
            <a href="{{trans_to($menu->url)}}" >
                <i class="{{{ $menu->icon or '' }}}"></i> <span>{{$menu->name}}</span>
                <b class="caret"></b>
            </a>
            @include('menu::menu.sub.default', array('menus' => $children))
        </li>
        @else
        <li  {{ isset($menu->active) ?  'class="active"' : '' }}>
            <a href="{{trans_to($menu->url)}}">
                <i class="{{{ $menu->icon or '' }}}"></i>
                {{$menu->name}}
            </a>
        </li>
        @endif
    @endforeach
</ul>
