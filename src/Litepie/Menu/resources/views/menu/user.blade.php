<div class="dashboard-side-nav m-t-5">
    <ul>
@foreach ($menus as $menu)
    @if ($menu->hasChildren())
    <li class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}" ><i class="{{$menu->icon}}"></i><span>{{$menu->name}}</span></a>
        @include('menu::menu.sub.user', array('menus' => $menu->getChildren()))
    </li>
    @else
    <li  class="{{ $menu->active or '' }}">
        <a href="{{trans_url($menu->url)}}"><i class="{{$menu->icon}}"></i><span>{{$menu->name}}</span></a>
    </li>
    @endif
@endforeach
    </ul>
</div>
