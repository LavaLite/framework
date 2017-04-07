<div class="row">
    <div class="col-sm-12">
        <div class="fileinput text-center">
            <img src='{!! url(@$src) !!}' alt="" class="img-responsive">
            <label class="btn-upload mt20" for="inputImage" title="Upload image file">
                <input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                <span class="btn btn-danger btn-raised ">
                  Upload new picture
                </span>
            </label>
        </div>
    </div>
</div>

{!!Form::hidden(@$field."[caption]")->disabled()!!}
{!!Form::hidden(@$field."[folder]")->disabled()!!}
{!!Form::hidden(@$field."[file]")->disabled()!!}

<div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn btn-danger btn-simple" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                <h3 class="modal-title">Crop your new profile picture</h3>
            </div>
            <div class="modal-body" style="min-height: 350px;">
                <div class='col-md-12'>
                    <div class="img-container">
                        <img id="image" src='{!! url(@$src) !!}' alt="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="docs-buttons">
                  <button type="button" class="btn btn-success btn-raised mt20" data-method="getCroppedCanvas">Set new profile picture</button>
                  <button type="button" class="btn btn-danger btn-raised mt20" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
$(function () {

  'use strict';

  var console = window.console || { log: function () {} };
  var URL = window.URL || window.webkitURL;
  var $image = $('#image');
  var options = {
        aspectRatio: 1 / 1,
        preview: '.img-preview',
      };
  var originalImageURL = $image.attr('src');
  var uploadedImageURL;
  var imageName = "user.jpg";

  // Cropper
  $image.on().cropper(options);


  // Methods
  $('.docs-buttons').on('click', '[data-method]', function () {
    var $this = $(this);
    var data = $this.data();
    var $target;
    var result;

    if ($image.data('cropper') && data.method) {
      data = $.extend({}, data); // Clone a new one

      if (typeof data.target !== 'undefined') {
        $target = $(data.target);

        if (typeof data.option === 'undefined') {
          try {
            data.option = JSON.parse($target.val());
          } catch (e) {
            console.log(e.message);
          }
        }
      }

      result = $image.cropper(data.method, data.option, data.secondOption);

      switch (data.method) {
        case 'getCroppedCanvas':
          if (result) {
            result.toBlob(function (blob) {
                var formData = new FormData();
                formData.append('cropping', result.toDataURL('image/jpeg'));
                formData.append('name', imageName);
                $.ajax({
                  url: "{{@$url}}",
                  method: "POST",
                  data: formData,
                  cache: false,
                  processData: false,
                  contentType: false,
                    success:function(data, textStatus, jqXHR)
                    {
                        $('input[name="{{@$field}}[caption]"], input[name="{{@$field}}[file]"], input[name="{{@$field}}[folder]"]').prop('disabled',false);
                        $('input[name="{{@$field}}[caption]"]').val(data.caption);
                        $('input[name="{{@$field}}[file]"]').val(data.file);
                        $('input[name="{{@$field}}[folder]"]').val(data.folder);
                        $( "#form-update-profile" ).submit();
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            });

          }

          break;
       
      }

      if ($.isPlainObject(result) && $target) {
        try {
          $target.val(JSON.stringify(result));
        } catch (e) {
          console.log(e.message);
        }
      }

    }
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
          $("#cropModal").modal("show");
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