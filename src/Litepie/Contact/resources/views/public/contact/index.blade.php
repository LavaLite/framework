<section class="contact">
    <div class="contact-details">
        <div class="container">
            <div class="row">
                <div class="col-md-6 contact-skew">
                    <div class="contact-detail-wraper">
                        <h1>Contacts</h1>
                        <div class="contact-icons">
                            <p><i class="icon-envelope-open"></i><span>{!!$contacts['email']!!}</span></p>
                            <p><i class="icon-phone"></i><span>{!!$contacts['phone']!!}</span></p>
                            <p><i class="icon-screen-smartphone"></i><span>{!!$contacts['mobile']!!}</span></p>
                        </div>
                        <br>
                         <p>{!!nl2br($contacts['address'])!!} </p>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Contact Us</h1>
                </div>
                @if(Session::has('success'))                        
                <div class="col-md-12">
                    <div class = "alert alert-success">{!! Session::get('success') !!}</div>
                </div>
                @endif
            </div>
            {!!Form::vertical_open()
            -> id('contactForm')
            -> method('POST')
            -> files('true')
            -> action(trans_url('contact.htm'))!!}
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="name" class="form-control" placeholder="Name" required>
                            <i class="form-control-feedback icon-user"></i>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="email" class="form-control" placeholder="Email" required>
                            <i class="form-control-feedback icon-envelope-open"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <textarea name="subject" id="subjcet" cols="30" rows="10" class="form-control" placeholder="Message"></textarea>
                            <i class="form-control-feedback icon-speech"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right">
                           <button type="submit" class="btn btn-danger waves-effect waves-float">Send Message</button>
                        </div>
                    </div>
             {!! Form::close() !!}
        </div>
    </div>
</section>
<script>
      function initMap() {
        var uluru = {lat: {!!$contacts['lat']!!}, lng:{!!$contacts['lng']!!}};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
</script>