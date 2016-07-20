@foreach ($menus as $menu)
    @if ($menu->hasChildren())
    <li class="{{ $menu->active or '' }} dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$menu->name}} <span class="ion ion-ios-arrow-down"></span></a>
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
