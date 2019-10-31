@if ($mode == 'list')
@include('master::project.list.default')
@else
@include('master::project.entry.default')
@endif