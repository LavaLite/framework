@foreach ($menus as $menu)
@if($menu->has_role)
@if ($menu->hasChildren())
<div class="dropdown has-child">
    <a class="dropdown-item has-child collapsed" data-toggle="collapse" href="{{trans_url($menu->url)}}" role="button"
        aria-expanded="false" aria-controls="userCollapse"><i
            class="{{{ $menu->icon ?? 'fa fa-angle-double-right' }}}"></i> <span>{{$menu->name}}</span></a>
    @include('menu::menu.sub.admin', array('menus' => $menu->getChildren()))

</div>
@else
<a class="dropdown-item" href="{{trans_url($menu->url)}}"><i
        class="{{{ $menu->icon ?? 'fa fa-angle-double-right' }}}"></i> <span>{{$menu->name}}</span></a>


@endif
@endif
@endforeach