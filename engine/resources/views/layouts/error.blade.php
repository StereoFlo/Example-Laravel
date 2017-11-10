<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ url('static/images/favicon/favicon.png') }}"/>
        <link rel="apple-touch-icon-precomposed" href="{{ url('static/images/favicon/apple-touch-favicon.png') }}"/>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('/static/css/main.min.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="errorWrapper">

            @yield('content')

        </div>

        <!-- Scripts -->
        <script type="text/javascript" src="//vk.com/js/api/openapi.js?150"></script>
        <script type="text/javascript">VK.init({apiId: 5683855, onlyWidgets: true});</script>
        <script src="{{ url('static/js/libs.min.js') }}"></script>
        <script src="{{ url('static/js/common.js') }}"></script>
    </body>
</html>
