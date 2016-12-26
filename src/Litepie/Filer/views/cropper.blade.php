
<div class="card">
    <div class="header header-icon" data-background-color="orange">
        <i class="pe-7s-album"></i>
    </div>
    <div class="content">
        <h4 class="card-title">Change Picture</h4>
        <div class="col-md-4">
            <div class="card">              
                <label>
                    <input type="file" class="sr-only" id="inputImage" name="photo" accept="image/*">
                    <img src="{{ theme_asset('img/picture.jpg') }}" class="img-responsive">
                </label>
            </div>
        </div>
        <div class="col-md-8">
            <div class="img-container">
                <img id="image">
                <div class="docs-buttons hide">
                    <div class="btn-group btn-group-crop pull-right">
                      <button type="button" class="btn-danger btn-raised btn btn-sm" data-method="getCroppedCanvas">
                        <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
                          Upload Image
                        </span>
                      </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

  // Cropper
  $image.on({
    'build.cropper': function (e) {
      console.log(e.type);
    },
    'built.cropper': function (e) {
      console.log(e.type);
    },
    'cropstart.cropper': function (e) {
      console.log(e.type, e.action);
    },
    'cropmove.cropper': function (e) {
      console.log(e.type, e.action);
    },
    'cropend.cropper': function (e) {
      console.log(e.type, e.action);
    },
    'crop.cropper': function (e) {
      console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
    },
    'zoom.cropper': function (e) {
      console.log(e.type, e.ratio);
    }
  }).cropper(options);


  // Methods
  $('.docs-buttons').on('click', '[data-method]', function () {
    var $this = $(this);
    var data = $this.data();
    var $target;
    var result;

    if ($this.prop('disabled') || $this.hasClass('disabled')) {
      return;
    }

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

      if (data.method === 'rotate') {
        $image.cropper('crop');
      }

      switch (data.method) {
        case 'scaleX':
        case 'scaleY':
          $(this).data('option', -data.option);
          break;

        case 'getCroppedCanvas':
          if (result) {
            result.toBlob(function (blob) {
                var formData = new FormData();
                formData.append('cropping', result.toDataURL('image/jpeg'));
                $.ajax({
                  url: "{{url('crop/litepie.user.user/WmmatNt8t8Rk8Q/photo/file')}}",
                  method: "POST",
                  data: formData,
                  cache: false,
                  processData: false,
                  contentType: false,
                  success:function(data, textStatus, jqXHR)
                  {
                    console.log(data);
                      console.log('Upload success');
                  },
                  error:function(data, textStatus, jqXHR)
                  {
                      console.log('Upload error');
                  }
                });
            });
            // Bootstrap's Modal
            /*$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

            if (!$download.hasClass('disabled')) {
              $download.attr('href', result.toDataURL('image/jpeg'));
            }*/
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
      $(".docs-buttons").removeClass('hide');
      
      if (!$image.data('cropper')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

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
