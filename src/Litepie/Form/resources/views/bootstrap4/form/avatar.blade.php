@php
if(is_array('$value')) {
    $image = head($value);
} else {
    $image = [
        'caption' => '',
        'file' => '',
        'folder' => '',
        'path' => '',
        'time' => '',
    ];
}
@endphp
<div class="{{$name}}-file-cropper text-center">
    <img src='{!! url()->to(@$src) !!}' alt="" class="img-responsive avatar-image" id="image-{{$name}}">
    <br />
    <div class="btn-group">

        <label class="btn btn-primary" for="inputImage" title="Change Image">
            <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Upload new image">
                <span class="fa fa-upload"></span>
            </span>
        </label>
        <button type="button" class="btn btn-primary" data-method="save" title="Destroy" id="{{$name}}-save-image">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Save">
                <span class="fa fa-floppy-o"></span>
            </span>
        </button>
    </div>
    <input type="hidden" name="{{$name}}[caption]" id="{{$name}}_caption" value="{{$image['caption']}}">
    <input type="hidden" name="{{$name}}[file]" id="{{$name}}_file" value="{{$image['file']}}">
    <input type="hidden" name="{{$name}}[folder]" id="{{$name}}_folder" value="{{$image['folder']}}">
    <input type="hidden" name="{{$name}}[path]" id="{{$name}}_path" value="{{$image['path']}}">
    <input type="hidden" name="{{$name}}[time]" id="{{$name}}_time" value="{{$image['time']}}">
</div>

<script type="text/javascript">
$(function() {
    'use strict';
    var URL = window.URL || window.webkitURL;
    var $image = $('#image-{{$name}}');
    var options = {
        aspectRatio: 1 / 1,
        preview: '.img-preview',
    };
    var originalImageURL = $image.attr('src');
    var uploadedImageURL;
    var imageName = "profile.png";

    // Cropper
    $image.cropper(options);

    // Methods
    $('#{{$name}}-save-image').on('click', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
        $image.cropper('getCroppedCanvas').toBlob(function(blob) {
            var formData = new FormData();

            formData.append('file', blob, imageName);

            $.ajax('{{@$url}}', {
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data, textStatus, jqXHR) {
                    $('#{{$name}}_caption').val(data.caption);
                    $('#{{$name}}_file').val(data.file);
                    $('#{{$name}}_folder').val(data.folder);
                    $('#{{$name}}_path').val(data.path);
                    $('#{{$name}}_time').val(data.time);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    app.message(jqXHR);
                }
            });
            return false;
        });
        return false;
    });


    // Import image
    var $inputImage = $('#inputImage');

    if (URL) {
        $inputImage.change(function() {
            var files = this.files;
            var file;

            if (!$image.data('cropper')) {
                return;
            }

            if (files && files.length) {
                file = files[0];
                imageName = file.name;
                if (/^image\/\w+$/.test(file.type)) {
                    if (uploadedImageURL) {
                        URL.revokeObjectURL(uploadedImageURL);
                    }
                    uploadedImageURL = URL.createObjectURL(file);
                    $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
                    $inputImage.val('');
                } else {
                    window.alert('Please choose an image file.');
                }
            }
        });
    } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
    }

});
</script>
<style type="">
    .avatar-image {
        background-color: tomato;
        color: white;
        border: 1px solid grey;
        margin: 20px;
        padding: 20px;
        width: 150px;
        height: 150px;
        border-radius: 76px;
    }
</style>