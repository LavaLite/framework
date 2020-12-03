<div class="dropright {{ $menu->active ?? '' }}">
        <a class="nav-link dropdown-toggle" href="{{trans_url($menu->url)}}" 
        data-toggle="dropdown" 
        aria-haspopup="true" 
        aria-expanded="false">
            <i class="{{ $menu->icon ?? 'las la-ellipsis-v' }}"></i>
        </a>
        <div class="dropdown-menu main-nav-dropdown">
        @foreach ($menus as $menu)
            @if($menu->has_role)
                @if ($menu->hasChildren())
                    @include('menu::menu.sub.admin', array('menus' => $menu->getChildren()))
                @else
                <a class="nav-link {{ $menu->active ?? '' }}" href="{{trans_url($menu->url)}}" data-toggle="tooltip" data-placement="right" title="{{$menu->name}}">
                    <i class="{{ $menu->icon ?? 'fa fa-angle-double-right' }}"></i>
                </a>
                @endif
            @endif
        @endforeach
    </div>
</div>
    
