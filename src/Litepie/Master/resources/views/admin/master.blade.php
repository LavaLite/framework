
@if ($mode == 'create')
    @include('master::create')
@elseif ($mode == 'edit')
    @include('master::edit')
@elseif ($mode == 'show')
    @include('master::show')
@elseif ($mode == 'list')
    @include('master::list')
@else
    @include('master::new')
@endif
