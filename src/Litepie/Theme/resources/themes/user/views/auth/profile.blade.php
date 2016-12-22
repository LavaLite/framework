<div class="content">
    <div class="container-fluid">
        @include('public::notifications')
        <div class="row">
            <div class="col-md-6">
            {!!Form::vertical_open()
            ->id('update-profile')
            ->method('POST')
            ->class('update-profile')!!}
                <div class="card">
                    <div class="header  header-icon" data-background-color="blue">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="content">
                        <h4 class="card-title">Update Profile</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="name">Name</label>
                                        {!! Form::text('name')
                                        -> label(trans('user::user.label.name'))
                                        -> raw()!!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="datepicker">Date of Birth</label>
                                        {!! Form::text('dob')
                                        -> label(trans('user::user.label.dob'))
                                        -> id('datepicker')
                                        -> raw()!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="designation">Designation</label>
                                        {!! Form::text('designation')
                                        -> label(trans('user::user.label.designation'))
                                        -> raw() !!}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group label-floating">
                                        <label for="mobile" class="control-label">Mobile</label>
                                        {!! Form::number('mobile')
                                        -> label(trans('user::user.label.mobile'))
                                        -> raw() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="phone">Phone</label>
                                        {!! Form::number('phone')
                                        -> label(trans('user::user.label.phone'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="address">Address</label>
                                        {!! Form::text('address')
                                        -> label(trans('user::user.label.address'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="street">Street</label>
                                        {!! Form::text('street')
                                        -> label(trans('user::user.label.street'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="city">City</label>
                                        {!! Form::text('city')
                                        -> label(trans('user::user.label.city'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="district">District</label>
                                        {!! Form::text('district')
                                        -> label(trans('user::user.label.district'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="state">State</label>
                                        {!! Form::text('state')
                                        -> label(trans('user::user.label.state'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="country">Country</label>
                                        {!! Form::text('country')
                                        -> label(trans('user::user.label.country'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label" for="web">Web</label>
                                        {!! Form::text('web')
                                        -> label(trans('user::user.label.web'))
                                        -> raw() !!}
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    <div class="footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn-primary btn-raised btn">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            </div>
            <div class="col-md-6">
                {!!Form::vertical_open()
                ->id('change-picture')
                ->method('POST')
                ->class('change-password')
                ->enctype('multipart/form-data')
                ->action(url('/upload/litepie.user.user/'.@$user->getRouteKey().'/photo/file'))!!} 
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
                                    <img src="{{url('img/female-upload-md.png')}}" class="img-responsive">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="test1"></div>
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
                {!! Form::close() !!}
            </div>
            <div class="col-md-6">
                {!!Form::vertical_open()
                ->id('contact')
                ->method('POST')
                ->class('change-password')
                ->action(getenv('guard').'/password')!!} 
                <div class="card">
                    <div class="header header-icon" data-background-color="orange">
                        <i class="material-icons">lock</i>
                    </div>
                    <div class="content">
                        <h4 class="card-title">Change Password</h4>
                            <div class="form-group label-floating">
                                <label class="control-label" for="old_password">Current Password</label>
                                {!! Form::password('old_password')
                              -> label(trans('user::user.label.current_password'))
                              -> raw() !!}
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="password">New Password</label>
                                {!! Form::password('password')
                                  -> label(trans('user::user.label.new_password'))
                                  -> raw() !!}
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label" for="password_confirmation">Confirm New Password</label>
                                {!! Form::password('password_confirmation')
                                  -> label(trans('user::user.label.new_password_confirmation'))
                                  -> raw() !!}
                            </div>
                    </div>
                    <div class="footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn-primary btn btn-raised">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
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
  var $download = $('#download');
  var $dataX = $('#dataX');
  var $dataY = $('#dataY');
  var $dataHeight = $('#dataHeight');
  var $dataWidth = $('#dataWidth');
  var $dataRotate = $('#dataRotate');
  var $dataScaleX = $('#dataScaleX');
  var $dataScaleY = $('#dataScaleY');
  var options = {
        aspectRatio: 1 / 1,
        preview: '.img-preview',
        crop: function (e) {
          $dataX.val(Math.round(e.x));
          $dataY.val(Math.round(e.y));
          $dataHeight.val(Math.round(e.height));
          $dataWidth.val(Math.round(e.width));
          $dataRotate.val(e.rotate);
          $dataScaleX.val(e.scaleX);
          $dataScaleY.val(e.scaleY);
        }
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
            /*$(".img-container").html("<image src='"+result.toDataURL('image/jpeg')+"'>");
            $("#test1").attr("value",result.toDataURL('image/jpeg'));
*/
            result.toBlob(function (blob) {
                var formData = new FormData();
                formData.append('croppedImage', blob);
                formData.append('cropping', result.toDataURL('image/jpeg'));
                $.ajax({
                  url: "{{url('crop/litepie.user.user/'.$user->getRouteKey().'/photo/file')}}",
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