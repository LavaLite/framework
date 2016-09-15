@if(!empty($files))
{!!Form::hidden($field)->id($field)->forceValue('0')!!}
<div id="file_{!!$field!!}">
    <?php
        $info = pathinfo($files['file']);
        $ext  = strtolower($info['extension']);
    ?>
    @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
        <a href='{!!$files["url"]!!}' target="_blank">
            <img src='{!! url("/image/{$size}/{$config}/".folder_encode($files["folder"]))!!}/{!! $files["file"] !!}' class="img-thumbnail image-responsive">
        </a>
    @else
        <a href='{!!$files["url"]!!}' target="_blank">{!!$files['file']!!}</a>
    @endif
    <a href="#" class="remove-image-{!!$field!!}">
        <span class="fa-stack fa-xs">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-times fa-stack-1x fa-inverse"></i>
        </span>
    </a>
    {!!Form::text($field."[caption]", 'Caption')->value(@$files['caption'])!!}
    {!!Form::hidden($field."[folder]")->value(@$files['folder'])->raw()!!}
    {!!Form::hidden($field."[file]")->value(@$files['file'])->raw()!!}
</div>
<script type="text/javascript">
$('document').ready(function(){
    $(".remove-image-{!!$field!!}").on('click', function(){
        $('#file_{!!$field!!}').remove();
        $('#{!!$field!!}_delete').val('[]');
    });
});
</script>
@else
Upload file.
@endif