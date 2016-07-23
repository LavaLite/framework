@if($count == 1)
    @if(!empty($files))
    {!!Form::hidden($field)->id($field)->forceValue('0')!!}
    <div id="file_{!!$field!!}">
        <?php
            $info = pathinfo($files['file']);
            $ext  = strtolower($info['extension']);
        ?>
        @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
            <a href="{!! url('/file/'.folder_encode($files['folder']))!!}/{!!$files['file']!!}" target="_blank">
                <img src="{!! url('/image/sm/'.folder_encode($files['folder']))!!}/{!! $files['file'] !!}" class="img-thumbnail image-responsive">
            </a>
        @else
            <a href="{!! url('/image/sm/'.folder_encode($files['folder']))!!}/{!!$files['file']!!}" target="_blank">{!!$files['file']!!}</a>
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
@else
    {!!Form::hidden($field)->forceValue('0')!!}
    <div id="sortable_{!!$field!!}">
        @forelse($files as $key => $file)
<?php
if (is_object($file)) {
    $file = (array) $file;
}
?>
        <div id="img_box_{!!$field!!}_{!!$key!!}" class="img_box col-md-3 col-sm-3 col-xs-6">
            <div class="img_container">
                <?php
                    $info = pathinfo($file['file']);
                    $ext  = strtolower($info['extension']);
                ?>
                @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
                    <a href="{!! url('/file/'.folder_encode($file['folder']))!!}/{!!$file['file']!!}" target="_blank"><img src="{!! url('/image/sm/'.folder_encode($file['folder']))!!}/{!! $file['file'] !!}" class="img-thumbnail image-responsive"></a>
                @else
                    <div id="file">
                        <a href="{!! url('/file/'.folder_encode($file['folder']))!!}/{!!$file['file']!!}" target="_blank">{!!$file['file']!!}</a>
                    </div>
                @endif
                <div class="btn_container">
                    <a href="#" class="remove-image" data-id='{!!$key!!}'>
                    <span class="fa-stack fa-xs">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-times fa-stack-1x fa-inverse"></i>
                    </span>
                    </a>
                    <a href="#"  data-toggle="modal" data-target="#img_popup_{!!$key!!}">
                    <span class="fa-stack fa-xs" >
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                    </span>
                    </a>
                </div>
            </div>
            <div class="modal fade  bs-example-modal-sm" tabindex="-1" id="img_popup_{!!$key!!}" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Caption</h4>
                        </div>
                        <div class="modal-body">
                            @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
                                <a href="{!! url('/file/'.$file['folder'])!!}/{!!$file['file']!!}" target="_blank"><img src="{!! url('/image/sm/'.folder_encode($file['folder']))!!}/{!! $file['file'] !!}" class="img-thumbnail image-responsive"></a>
                            @else
                                <a href="{!! url('/file/'.folder_encode($file['folder']))!!}/{!!$file['file']!!}" target="_blank">{!!$file['file']!!}</a>
                            @endif
                            {!!Form::text($field."[$key][caption]", 'Caption')->value(@$file['caption'])!!}
                            {!!Form::hidden($field."[$key][folder]")->value(@$file['folder'])->raw()!!}
                            {!!Form::hidden($field."[$key][time]")->value(@$file['time'])->raw()!!}
                            {!!Form::hidden($field."[$key][file]")->value(@$file['file'])->raw()!!}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Save &amp; Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        Upload file(s).
        @endif
    </div>

    <script type="text/javascript">
    $('document').ready(function(){
        $(".remove-image").on('click', function(e){
            $(this).parents('.img_box').remove();
            e.preventDefault();
        });
        var el = document.getElementById('sortable_{!!$field!!}');
        var sortable = Sortable.create(el);
    });
    </script>
@endif