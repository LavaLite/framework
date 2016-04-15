<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('public::notifications')
            <div class="jumbotron">
                <h2>
                    Verify your email!
                </h2>
                <p>
                    You registration is successful verify your email before proceeding by clicking the link provided in the email. If you didn't receive a mail click on the button to get the verification mail again.
                </p>
                <p>
                    <a class="btn btn-primary btn-large" href="{{asset('verify/send')}}">Re-send verification email</a>
                </p>
            </div>
        </div>
    </div>
</div>
