@if($count == 1)
@include('filer::single.editor')
@else
@include('filer::multiple.editor')
@endif