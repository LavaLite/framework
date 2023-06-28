<ul class="nav ">
    @foreach ($menus as $menu)
        @if (count($children = $menu->getChildren()))
        <li class="{{ $menu->active ?? '' }}"  role="button" class="dropdown-toggle" data-toggle="dropdown">
            <a href="{{trans_url($menu->url)}}"  target="{{ $menu->target ?? '' }}">
                <i class="{!! $menu->icon ?? '' !!}"></i> <span>{{$menu->name}}</span>
                <b class="caret"></b>
            </a>
            @include('menu::menu.sub.default', array('menus' => $children))
        </li>
        @else
        <li  class="{{ $menu->active ?? '' }}">
            <a href="{{trans_url($menu->url)}}" target="{{ $menu->target ?? '' }}">
                <i class="{!! $menu->icon ?? '' !!}"></i>
                <p>{{$menu->name}}</p>
            </a>
        </li>
        @endif
    @endforeach
</ul>
