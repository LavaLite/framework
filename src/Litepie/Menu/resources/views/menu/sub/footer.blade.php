
@foreach ($menus as $menu)
    <a href="{{trans_url($menu->url)}}" >{{$menu->name}}</a>
    @if ($menu->hasChildren())
        @include('menu::menu.sub.admin', array('menus' => $menu->getChildren()))
    @endif
@endforeach
