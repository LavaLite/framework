 <ul class="nav">                       
@foreach ($menus as $menu)
    @if ($menu->hasChildren())
    <li class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}" ><i class="material-icons">{{$menu->icon}}</i><p>{{$menu->name}}</p></a>
        @include('menu::menu.sub.aside', array('menus' => $menu->getChildren()))
    </li>
    @else  
    <li  class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}"><i class="material-icons" >{{$menu->icon}}</i><p>{{$menu->name}}</p></a>
    </li>
    @endif
@endforeach
</ul>