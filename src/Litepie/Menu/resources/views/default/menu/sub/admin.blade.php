<div class="collapse show" id="userCollapse" style="">
    <div class="dropdown-inner">
        @foreach ($menus as $menu)
        @if($menu->has_role)
        @if ($menu->hasChildren())
        <a class="dropdown-item" href="{{trans_url($menu->url)}}"><i
                class="{{{ !empty($menu->icon) ?  $menu->icon : 'fa fa-angle-double-right' }}}"></i>
            <span>{{$menu->name}}</span>
        </a>
        @include('menu::menu.sub.admin', array('menus' => $menu->getChildren()))

        @else

        <a class="dropdown-item" href="{{trans_url($menu->url)}}"><i
                class="{{{ !empty($menu->icon) ?  $menu->icon : 'fa fa-angle-double-right' }}}"></i>
            <span>{{$menu->name}}</span>

        </a>

        @endif
        @endif
        @endforeach


    </div>
</div>