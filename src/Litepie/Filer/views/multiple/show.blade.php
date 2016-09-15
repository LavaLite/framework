@forelse($files as $key => $file)
    <?php
        $info = pathinfo($file['file']);
        $ext  = strtolower($info['extension']);
    ?>
    @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
        <a href='{!!$file["url"]!!}' target="_blank">
        <img src='{!! url("/image/{$size}/{$config}/".folder_encode($file["folder"]))!!}/{!! $file["file"] !!}' class="img-thumbnail image-responsive">
        </a>
    @else
        <div id="file">
            <a href='{!!$file["url"]!!}' target="_blank">{!!$files["file"]!!}</a>
        </div>
    @endif
@empty
Files not uploaded.
@endif