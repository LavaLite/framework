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

        {!! Theme::asset()->styles() !!}
        {!! Theme::asset()->scripts() !!}
    </head>

    <body class="public">

        {!! Theme::partial('header') !!}
        <div class="container content wraper">
        {!! Theme::content() !!}
        </div>
        {!! Theme::partial('footer') !!}
        <script src="{{ theme_asset('js/vendor.js') }}"></script>
        <script src="{{ theme_asset('js/main.js') }}"></script>
        {!! Theme::asset()->container('footer')->scripts() !!}
    </body>
</html>
