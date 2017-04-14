
<div class="{{$field}}-file-cropper text-center">
    <img src='{!! url(@$src) !!}' alt="" class="img-responsive" id="image-{{$field}}">
    <br/>
    <div class="btn-group">

    <label class="btn btn-primary" for="inputImage" title="Change Image">
      <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Upload new image">
        <span class="fa fa-upload"></span>
      </span>
    </label>
    <button type="button" class="btn btn-primary" data-method="save" title="Destroy" id="{{$field}}-save-image">
      <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="Save">
        <span class="fa fa-floppy-o"></span>
      </span>
    </button>
  </div>
</div>

<script type="text/javascript">
$(function () {

  'use strict';

  var URL = window.URL || window.webkitURL;
  var $image = $('#image-{{$field}}');
  var options = {
        aspectRatio: 1 / 1,
        preview: '.img-preview',
      };
  var originalImageURL = $image.attr('src');
  var uploadedImageURL;
  var imageName = "profile.jpg";

  // Cropper
  $image.cropper(options);

  // Methods
  $('#{{$field}}-save-image').on('click', function () {
    // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
    $image.cropper('getCroppedCanvas').toBlob(function (blob) {
      var formData = new FormData();

      formData.append('file', blob, imageName);

      $.ajax('{{@$url}}', {
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR) {
                app.message(jqXHR);
        },
        error: function (jqXHR, textStatus, errorThrown) {
                app.message(jqXHR);
        }
      });
    });
  });


  // Import image
  var $inputImage = $('#inputImage');

  if (URL) {
    $inputImage.change(function () {
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