<ul class="dropdown-menu animated fadeIn" role="menu">
    @foreach ($menus as $menu)
        @if ($children = $menu->getChildren())
        <li class="{{ $menu->active or '' }}"  role="button" class="dropdown-toggle" data-toggle="dropdown">
            <a href="{{trans_url($menu->url)}}"  target="{{ $menu->target or '' }}">
                <i class="{!! $menu->icon or '' !!}"></i> <span>{{$menu->name}}</span>
                <b class="caret"></b>
            </a>
            @include('menu::menu.sub.bootstrap', array('menus' => $children))
        </li>
        @else
        <li  class="{{ $menu->active or '' }}">
            <a href="{{trans_url($menu->url)}}"  target="{{ $menu->target or '' }}">
                <i class="{!! $menu->icon or '' !!}"></i>
                {{$menu->name}}
            </a>
        </li>
        @endif
    @endforeach
</ul>
