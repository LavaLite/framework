@if ($mode == 'list')
@include('master::master.list.default')
@else
@include('master::master.entry.default')
@endif