<ul class="dropdown-menu animated fadeIn" role="menu">
    @foreach ($menus as $menu)
        @if ($children = $menu->getChildren())
        <li class="{{ $menu->active ?? '' }}"  role="button" class="dropdown-toggle" data-toggle="dropdown">
            <a href="{{trans_url($menu->url)}}"  target="{{ $menu->target ?? '' }}">
                <i class="{!! $menu->icon ?? '' !!}"></i> <span>{{$menu->name}}</span>
                <b class="caret"></b>
            </a>
            @include('menu::menu.sub.bootstrap', array('menus' => $children))
        </li>
        @else
        <li  class="{{ $menu->active ?? '' }}">
            <a href="{{trans_url($menu->url)}}"  target="{{ $menu->target ?? '' }}">
                <i class="{!! $menu->icon ?? '' !!}"></i>
                {{$menu->name}}
            </a>
        </li>
        @endif
    @endforeach
</ul>
