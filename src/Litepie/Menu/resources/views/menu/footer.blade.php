<ul class="nav navbar-nav navbar-right" style="padding-right: 80px;">
@foreach ($menus as $menu)
    @if ($menu->hasChildren())
    <li class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}" >{{$menu->name}}</a>
        @include('menu::menu.sub.footer', array('menus' => $menu->getChildren()))
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
