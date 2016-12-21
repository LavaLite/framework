
@foreach ($menus as $menu)
    @if ($menu->hasChildren())
    <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                <span class="icon hidden-sm hidden-xs"><i class="{{$menu->icon}}"></i></span>
                <span class="text">{{$menu->name}}</span>
            </a>
            <ul class="dropdown-menu">
                    @include('menu::menu.sub.user', array('menus' => $menu->getChildren()))                
            </ul>
    </li> 
    @else
    <li  class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}"><!-- <i class="{{$menu->icon}}"></i> --><span class="text">{{$menu->name}}</span></a>
    </li>
    @endif
@endforeach
