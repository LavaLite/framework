<!-- Start image display for {!!$field!!} -->
<div  class="image-display">
@forelse($files as $key => $file)
    @php
        $info = pathinfo($file['file']);
        $ext  = strtolower($info['extension']);
    @endphp
    @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
        <a href='{!!$file["url"]!!}' target="_blank">
            <img src='{!! url("/image/{$config}/{$size}/".folder_encode($file["folder"]))!!}/{!! $file["file"] !!}' class="img-thumbnail image-responsive">
        </a>
    @else
        <a href='{!!$file["url"]!!}' target="_blank">{!!$files["file"]!!}</a>
    @endif
@empty
Files not uploaded.
@endif
</div>
<!-- End image display. -->
