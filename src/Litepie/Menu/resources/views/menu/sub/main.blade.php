<ul class="dropdown-menu">
@foreach ($menus as $menu)
    @if ($menu->hasChildren())
    <li class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}" >{{$menu->name}} S</a>
        @include('menu::menu.sub.main', array('menus' => $menu->getChildren()))
    </li>
    @else
    <li  class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}">
            {{$menu->name}}
        </a>
    </li>
    @endif
@endforeach
</ul>
