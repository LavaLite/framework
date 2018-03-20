<ul class="nav">
@foreach ($menus as $menu)
        <a href="{{$menu->url}}" target="_blank">
        <i class="{{$menu->icon}}"> </i>
        </a>
@endforeach
</ul>
