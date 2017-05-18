<ul class="treeview-menu {{ $menus->active or '' }}">
    @foreach ($menus as $menu)
        @if($menu->has_role)
            @if ($menu->hasChildren())
            <li class="treeview {{ $menu->active or '' }}">
                <a href="{{trans_url($menu->url)}}" >
                    <i class="{{{ !empty($menu->icon) ?  $menu->icon : 'fa fa-angle-double-right' }}}"></i> <span>{{$menu->name}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                @include('menu::menu.sub.admin', array('menus' => $menu->getChildren()))
            </li>
            @else
            <li  class="{{ $menu->active or '' }}">
                <a href="{{trans_url($menu->url)}}">
                    <i class="{{{ !empty($menu->icon) ?  $menu->icon : 'fa fa-angle-double-right' }}}"></i>
                    <span>{{$menu->name}}</span>
                </a>
            </li>
            @endif
        @endif
    @endforeach
</ul>
