<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>{{ Theme::getTitle() }}</title>
        <meta name="description" content="The Lavalite Content Management System">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="{{asset('apple-touch-icon.png')}}">
        <link href="{{ theme_asset('css/vendor.css') }}" rel="stylesheet">
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        {!! Theme::asset()->styles() !!}
        {!! Theme::asset()->scripts() !!}
    </head>


    <body class="body-bg-full auth login" style="background-image: url({{theme_asset('img/lock.jpg')}});">
    
        {!! Theme::partial('auth.header') !!}
        {!! Theme::content() !!}
        {!! Theme::partial('auth.footer') !!}

        <script src="{{ theme_asset('js/vendor.js') }}"></script>
        <script src="{{ theme_asset('js/main.js') }}"></script>
        {!! Theme::asset()->container('footer')->scripts() !!}
    </body>
</html>
