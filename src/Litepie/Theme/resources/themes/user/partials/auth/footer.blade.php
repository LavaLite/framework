<footer class="footer">
    <div class="container">
        <div class="col-lg-12 text-center"> 
            @if(Request::is('*login'))
            <a href="{{trans_url(get_guard('url')."/register")}}" class="text-white">Create an Account</a>
            @else
            <a href="{{trans_url(get_guard('url')."/login")}}" class="text-white">Looking for Login?</a>
            @endif
            <div class="copyright"> Lavalite © 2017 All Rights Reserved. Powered by <a href="http://renfos.com/" target="_new">Renfos Technologies Pvt Ltd</a>. </div>
        </div>
    </div>
</footer>