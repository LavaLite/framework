<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            You registration is successful verify your email before proceeding by clicking the link below.
            <a href="{{ URL::to($guard . '/verify/' . $confirmation_code) }}">
            {{ URL::to($guard . '/verify/' . $confirmation_code) }}
            </a>.<br/>

        </div>

    </body>
</html>
