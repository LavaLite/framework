        <div class="landing">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="wizard-container">
                            <div class="wizard-card" id="wizard">
                                <div class="wizard-content text-center">
                                    <a href="index.html"><img src="{{asset('img/logo/logo.svg')}}" class="img-responsive center-block mb10" alt=""></a>
                                    <h1>Installation Wizard</h1>
                                    <p>Nevertheless of what programming talent level you have, Lavalite will guide you in creating cool and professional websites - through the stages of design, innovate and manage, irrespective of what audience they are built for.</p>
                                    <ul>
                                        <li>{!!check(class_exists('DomDocument'), 'PHP >= 5.6.4')!!} </li>
                                        <li>{!!check(class_exists('DomDocument'), 'OpenSSL PHP Extension.')!!} </li>
                                        <li>{!!check(class_exists('PDO'), 'PDO PHP Extension.')!!} </li>
                                        <li>{!!check(function_exists('mb_strlen'), 'Mbstring PHP Extension.')!!} </li>
                                        <li>{!!check(function_exists('token_get_all'), 'Tokenizer PHP Extension.')!!} </li>
                                        <li>{!!check(class_exists('DomDocument'), 'XML PHP Extension.')!!} </li>
                                        <li>{!!check(extension_loaded('fileinfo'), 'Fileinfo PHP extension')!!} </li>

                                    </ul>
                                </div>
                                <div class="footer text-center">
                                    <a href="install/db" class="btn btn-danger start-btn">Let's Start</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php
$passed = true;
function check($boolean, $text, $fatal = false) {
    global $passed;
    if ($boolean) {
        return '<i class="fa fa-check" style="color:green"></i> ' . $text;
    } 
    if (!$fatal) {
        $passed = false;
    } 
    return '<i class="fa fa-times" style="color:red"></i> ' . $text;

}
?>
