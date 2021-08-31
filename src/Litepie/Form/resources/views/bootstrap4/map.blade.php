<div class="row">
    <div class='col-md-6 col-sm-6'>
        <input type="text" class="form-control" id="{!!$latField!!}" value="{!! $latitude !!}" name="{!!$latField!!}"
            placeholder="{!!__('Latitude')!!}">
    </div>

    <div class='col-md-6 col-sm-6'>
        <input type="text" class="form-control" id="{!!$lngField!!}" value="{!! $longitude !!}" name="{!!$lngField!!}"
            placeholder="{!!__('Longitude')!!}">
    </div>
    <div class='col-md-12'>
        <div id="{!!$name!!}_map_canvas" style="height: 530px;width: 100%"></div>
    </div>
</div>
<script type="text/javascript">
  $(function(){
    var map, myLatlng;
    var myLatlng = new google.maps.LatLng({!! $latitude !!},{!! $longitude !!});

      var myOptions = {
         zoom: 10,
         center: myLatlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP
         }
      map = new google.maps.Map(document.getElementById("{!!$name!!}_map_canvas"), myOptions);
      var marker = new google.maps.Marker({
      draggable: true,
      position: myLatlng,
      map: map,
      title: "Your location"
      });
      google.maps.event.addListener(marker, 'dragend', function (event) {
        $("#lat").val(this.getPosition().lat());
        $("#lng").val(this.getPosition().lng());
    });
  })
</script>       