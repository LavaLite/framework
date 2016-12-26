<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{!! Theme::getTitle() !!}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="csrf-token" content="{{ csrf_token() }}">
         <?php @$font=@Settings::get('font');?>     
         <?php @$color=@Settings::get('admin-color');?>     
        <link href="{{@$font->type=='User' ?  @$font->value : 'https://fonts.googleapis.com/css?family=Open+Sans:400,300'}}" rel='stylesheet' type='text/css'>

<link href="{{ theme_asset('css/vendor.css') }}" rel="stylesheet">

{!! Theme::asset()->styles() !!}
{!! Theme::asset()->scripts() !!}
    </head>
         

    <body class="sidebar-mini  skin-{{@$color->type=='User' ? @$color->value :'red' }}" >
        <div class="wrapper">
            {!! Theme::partial('header') !!}
            {!! Theme::partial('aside') !!}
            {!! Theme::content() !!}
            {!! Theme::partial('right') !!}
            {!! Theme::partial('footer') !!}
        </div>
    </body>
<script src="{{ theme_asset('js/vendor.js') }}"></script>
{!! Theme::asset()->container('footer')->scripts() !!}
{!! Theme::asset()->container('extra')->scripts() !!}
</html>




