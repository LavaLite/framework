@php
$name = Str::slug($name)
@endphp
@if($mode == 'show')
<!-- Start image display for {!!$name!!} -->
<div  class="image-display">
@if(is_array($value))
@foreach($value as $key => $file)
    @php
        $info = pathinfo($file['file']);
        $ext  = strtolower($info['extension']);
    @endphp
    @if (in_array($ext, ['jpg','jpeg', 'png', 'gif']) )
        <a href='{!! url("/image/{$largeSize}/".$file["path"])!!}' target="_blank">
            <img src='{!! url("/image/{$thumbSize}/".$file["path"])!!}' class="img-thumbnail image-responsive">
        </a>
    @else
        <a href='{{url('/file/download')}}/{!!$file["path"]!!}' target="_blank" class="show-file">{!!$file["file"]!!}</a><br/>
    @endif
@endforeach
@else
Files not uploaded.
@endif
</div>
<!-- End image display. -->
@else
<!-- Start dropzone for {!!$name!!}_files -->
<div class="upload-wraper">

    <div class="drop-zone  dropzone-previews" id="{!!$name!!}_files">
        <div class="dz-message" data-dz-message><span><i class="fas fa-cloud-upload-alt fa-w-20 fa-4x"></i></span></div>
    </div>

    <!-- Start image editor for {!!$name!!}_files -->
    <input type="hidden" name="{!!$id!!}" id="{!!$id!!}" value="[]">
    <div id="sortable_{!!$name!!}_files" class="image-editor">
    </div>
</div>

<script type="text/javascript">
$(function () {
    var template_{!!$name!!}_imag = $("#template_{!!$name!!}_imag").html();
    var template_{!!$name!!}_file = $("#template_{!!$name!!}_file").html();

    Dropzone.autoDiscover = false;
    if (("div#{!!$name!!}_files").dropzone) {
        ("div#{!!$name!!}_files").dropzone.destroy();
    }
    $("div#{!!$name!!}_files").dropzone({
        url: "{!! $url !!}",
        maxFiles: {!!$count!!},
        acceptedFiles: "{{$mime}}",
        parallelUploads : 1,
        maxfilesexceeded: function(file) {
            toastr.error('Files exceedes maximum size.', 'Error');
        },
        sending: function(file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            // Laravel expect the token post value to be named _token by default
        },
        init: function() {
            this.on("success", function(file, response) {
                response['i'] = ++i;
                if(["jpg", "jpeg", "png"].indexOf(response.file.split('.').pop()) >= 0){
                    rendered = Mustache.render(template_{!!$name!!}_imag, response);
                } else {
                    rendered = Mustache.render(template_{!!$name!!}_file, response);
                }
                $('#sortable_{!!$name!!}_files').append(rendered);
                toastr.success('Files uploaded successfully.', 'Success');
            });
        },
        complete: function(file) {
          this.removeFile(file);
        }
    });

    var {!!$name!!}_files = {!!json_encode($value)!!};
    Mustache.parse(template_{!!$name!!}_imag);
    Mustache.parse(template_{!!$name!!}_file);
    var rendered = '';
    var i = 1;
    $.each({!!$name!!}_files, function( index, value ) {
        i = index;
        value['i'] = index;

        if(["jpg", "jpeg", "png"].indexOf(value.file.split('.').pop()) >= 0){
            rendered = rendered + Mustache.render(template_{!!$name!!}_imag, value);
        } else {
            rendered = rendered + Mustache.render(template_{!!$name!!}_file, value);
        }
    });

    $('#sortable_{!!$name!!}_files').html(rendered);
    rendered = '';
});
</script>

<!-- End dropzone. -->
<script id="template_{!!$name!!}_file" type="x-tmpl-mustache">
    <div class="file-box" id="image_box_@{{i}}">
        <div class="file-container">
            <a href="{!!url("/file/download")!!}/@{{path}}" target="_blank" >
                @{{file}}
            </a> 
            <a href="#" class="remove-file">
                <i class="fa fa-times"></i>
            </a>
        </div>                
        <input class="form-control" type="hidden" name="{!!$name!!}[@{{i}}][folder]" value="@{{folder}}">
        <input class="form-control" type="hidden" name="{!!$name!!}[@{{i}}][time]" value="@{{time}}">
        <input class="form-control" type="hidden" name="{!!$name!!}[@{{i}}][path]" value="@{{path}}">
        <input class="form-control" type="hidden" name="{!!$name!!}[@{{i}}][file]" value="@{{file}}">
    </div>
</script>

<!-- End dropzone. -->
<script id="template_{!!$name!!}_imag" type="x-tmpl-mustache">
    <div class="img-box" id="image_box_@{{i}}">
        <div class="img-container">
            <a href='{!!url("/image")!!}/{{$largeSize}}/@{{path}}' target="_blank" >
                <img src='{!!url("/image")!!}/{{$thumbSize}}/@{{path}}' class="img-responsive" alt="">
            </a>
            <div class="btn-container">
                <a href="#" class="move-image">
                    <i class="fas fa-arrows-alt"></i>
                </a>
                <a href="#" class="edit-image" data-target='image_box_@{{i}}_img'>
                    <i class="fas fa-pencil-alt"></i>
                </a>
                <a href="#" class="remove-image">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="modal fade" id="image_box_@{{i}}_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div id="main-img">
                                <img src='{!!url("/image/xs")!!}/@{{path}}' class="img-responsive" alt="">
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <label for="{!!$name!!}_@{{i}}_title">Title</label>
                                <input type="text" class="form-control" id="{!!$name!!}_@{{i}}_title" type="text" name="{!!$name!!}[@{{i}}][title]" value="@{{title}}" placeholder="Image Title">
                            </div>
                            <div class="form-group">
                                <label for="{!!$name!!}_@{{i}}_caption">Caption</label>
                                <input type="text" class="form-control" id="{!!$name!!}_@{{i}}_caption" type="text" name="{!!$name!!}[@{{i}}][caption]" value="@{{caption}}" placeholder="Image Caption">
                            </div>
                            <div class="form-group">
                                <label for="{!!$name!!}_@{{i}}_url">Url</label>
                                <input type="text" class="form-control" id="{!!$name!!}_@{{i}}_url" type="text" name="{!!$name!!}[@{{i}}][url]" value="@{{url}}" placeholder="Image URL">
                            </div>
                            <div class="form-group">
                                <label for="{!!$name!!}_@{{i}}_desc">Description</label>
                                <textarea class="form-control" id="{!!$name!!}_@{{i}}_desc" type="text" name="{!!$name!!}[@{{i}}][desc]" placeholder="Image Description" rows="5">@{{desc}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="form-control" type="hidden" name="{!!$name!!}[@{{i}}][folder]" value="@{{folder}}">
                    <input class="form-control" type="hidden" name="{!!$name!!}[@{{i}}][time]" value="@{{time}}">
                    <input class="form-control" type="hidden" name="{!!$name!!}[@{{i}}][path]" value="@{{path}}">
                    <input class="form-control" type="hidden" name="{!!$name!!}[@{{i}}][file]" value="@{{file}}">
                    <button type="button" class="btn btn-primary"  data-dismiss="modal">Save &amp close</button>
                </div>
                </div>
            </div>
        </div>                   
    </div>
</script>
<script type="text/javascript">
$(function () {
    var el = document.getElementById('sortable_{!!$name!!}_files');
    var sortable = Sortable.create(el, {
        handle: ".move-image"
    });

});
</script>

@if($fileInstanceCount <= 1)

<script type="text/javascript">
$(function () {
    $(document.body).on('click', ".remove-image", function(e){
        $(this).parents('.img-box').remove();
        e.preventDefault();
    });

    $(document.body).on('click', ".remove-file", function(e){
        $(this).parents('.file-box').remove();
        e.preventDefault();
    });

    $(document.body).on('click', ".btn-close", function(e){
        $(this).parents(".edit-wraper").hide();
        e.preventDefault();
    })
    
    $(document.body).on('click', ".edit-image", function(e){

        modal    = $(this).data('target');
        $('#'+modal).modal('show')




        poff    = $(this).parents('.upload-wraper').offset();
        toff    = $(this).offset();
        mleft    = poff.left - toff.left;
        mtop     = poff.top - toff.top;

        $(this).parents('.img-box').children(".edit-wraper").css('margin-top', mtop-83);
        $(this).parents('.img-box').children(".edit-wraper").css('margin-left', mleft+67);
        $(this).parents('.img-box').children(".edit-wraper").show();
        e.preventDefault();
    });

});
</script>
<style type="text/css">
.upload-wraper .drop-zone {
    border-radius: 10px 10px 10px 10px;
    -moz-border-radius: 10px 10px 10px 10px;
    -webkit-border-radius: 10px 10px 10px 10px;
    padding: 0;
    display: inline-block;
    float: left;
    min-height: auto;
}
.upload-wraper .drop-zone{
    border-radius: 10px 10px 10px 10px;
    -moz-border-radius: 10px 10px 10px 10px;
    -webkit-border-radius: 10px 10px 10px 10px;
    border: 1px dashed #000000;
    margin: 10px;
    width:100px;
    height:80px;
}
.upload-wraper .drop-zone .dz-message {
    text-align: center;
    margin: 1em 0;
}

.upload-wraper .drop-zone .addfile {
    display: inline-block;
    background-color: #f44336;
    box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2);
    border-radius: 10px;
    cursor: pointer;
    height: 100px;
    width: 100px;
    text-align: center;
    margin: 10px;
}
.upload-wraper .drop-zone .addfile .add-file i {
    font-size: 60px;
    color: #fff;
    line-height: 100px;
}
.upload-wraper .drop-zone .addfile .add-file {
    margin: 0;
    display: inline-block;
}

.upload-wraper .image-editor .img-box {
    margin: 10px;
    width: 100px;
    display: inline-block;
}
.upload-wraper .image-editor .img-box .img-container img {
    border-radius: 10px;
}
.upload-wraper .image-editor .img-box .img-container {
    position: relative;
}
.upload-wraper .image-editor .img-box .img-container .btn-container {
    position: absolute;
    top: -10px;
    right: -10px;
    z-index: 999;
}
.upload-wraper .image-editor .img-box .img-container .btn-container a {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    box-shadow: 0 14px 26px -12px rgba(0, 188, 212, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 188, 212, 0.2);
    background-color: #00bcd4;
    color: #fff;
    text-align: center;
    font-size: 12px;
    line-height: 20px;
    opacity: 0;
}
.upload-wraper .image-editor .img-box .img-container .btn-container a.remove-image {
    background-color: #f44336;
    box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2);
}
.upload-wraper .image-editor .img-box .img-container .btn-container a.move-image {
    background-color: #9c27b0;
    box-shadow: 0 14px 26px -12px rgba(156, 39, 176, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(156, 39, 176, 0.2);
}
.upload-wraper .image-editor .img-box:hover .img-container .btn-container a.move-image {
    opacity: 1;
    animation: scaleIn 0.6s;
}
.upload-wraper .image-editor .img-box:hover .img-container .btn-container a.edit-image {
    opacity: 1;
    animation: scaleIn 0.4s;
}
.upload-wraper .image-editor .img-box:hover .img-container .btn-container a.remove-image {
    opacity: 1;
    animation: scaleIn 0.2s;
}
.upload-wraper .edit-wraper {
    position: absolute;
    width: 95%;
    height: 99%;
    overflow-x: hidden;
    overflow-y: auto;
    background: white;
    padding: 10px;
    z-index: 1001
}
.upload-wraper {
    border-style: dotted;
    border-width: 1px;
    min-height: 200px
}
.upload-wraper .move-image {
  cursor: move;
  cursor: -webkit-grabbing;
}
.dropzone .dz-message {
    text-align: center;
    margin: 1.5em 0;
}
</style>
<!-- End dropzone for {!!$name!!}_files -->
@endif
@endif