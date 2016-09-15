@if(!empty($files))
    <?php
        $info = pathinfo($files['file']);
        $ext  = strtolower($info['extension']);
    ?>
    @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
        <a href='{!!$files["url"]!!}' target="_blank">
        <img src='{!! url("/image/{$size}/{$config}/".folder_encode($files["folder"]))!!}/{!! $files["file"] !!}' class="img-thumbnail image-responsive">
        </a>
    @else
        <div id="file">
            <a href='{!!$files["url"]!!}' target="_blank">{!!$files["file"]!!}</a>
        </div>
    @endif
@else
	File not uploaded.
@endif