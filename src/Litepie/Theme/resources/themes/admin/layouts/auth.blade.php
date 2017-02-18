<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <title>{!! Theme::getTitle() !!}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ theme_asset('css/vendor.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        {!! Theme::asset()->styles() !!}
        {!! Theme::asset()->scripts() !!}
    </head>
    <body class="login-page">
      {!! Theme::content() !!}
    </body>
    {!! Theme::asset()->container('footer')->scripts() !!}
    <script src="{{ theme_asset('js/vendor.js') }}"></script>
</html>
