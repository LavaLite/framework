<!-- Start image display for {!!$field!!} -->
<div  class="image-display">
@forelse($files as $key => $file)
    @php
        $info = pathinfo($file['file']);
        $ext  = strtolower($info['extension']);
    @endphp
    @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
        <a href='{!! url("/image/original/".$file["path"])!!}' target="_blank">
            <img src='{!! url("/image/{$size}/".$file["path"])!!}' class="img-thumbnail image-responsive">
        </a>
    @else
        <a href='{{url('/file/download')}}/{!!$file["path"]!!}' target="_blank" class="show-file">{!!$file["file"]!!}</a><br/>
    @endif
@empty
Files not uploaded.
@endif
</div>
<!-- End image display. -->
