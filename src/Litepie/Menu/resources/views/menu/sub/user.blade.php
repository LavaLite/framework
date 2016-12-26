
@foreach ($menus as $menu)
    @if ($menu->hasChildren())
    <li class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}" ><p>{{$menu->name}}</p></a>
        @include('menu::menu.sub.main', array('menus' => $menu->getChildren()))
    </li>
    @else
    <li  class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}"><p>{{$menu->name}}</p></a>
    </li>
    @endif
@endforeach
