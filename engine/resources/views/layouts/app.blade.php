<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
{{--    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('/static/css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <header class="header header_white">
            <div class="container">
                <div class="flex">
                    <div class="logo">
                        <a href="{{ url('index.html') }}">
                            <img src="{{ url('static/images/logo_dark.png') }}" alt="Logo" class="logo__pic">
                            <img src="{{ url('static/images/logo_mini.png') }}" alt="Logo" class="logo__picMin">
                        </a>
                    </div>
                    <a href="#" class="menu__btn">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </a>
                    <nav class="nav">
                        <a href="{{ url('index.html') }}" class="nav__link">Главная</a>
                        <a href="#" class="nav__link">Галерея</a>
                        <a href="#" class="nav__link">О нас</a>
                        <a href="#" class="nav__link">Общалка</a>
                        <a href="#" class="nav__link">Контакты</a>
                    </nav>
                    <div class="user">
                        <a href="#" class="user__btn">
                            {{--<i class="fa fa-user" aria-hidden="true"></i>--}}
                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                            <!-- <span>вход</span> -->
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <div class="main">
            @yield('content')
        </div>


        <footer class="footer">
            <div class="container">
                <div class="flex">
                    <div class="footer__brand">
                        <a href="#"><img src="{{url('static/images/logo-min.png')}}" alt=""></a>
                        <span class="sm-fs-12 xs-block">&copy; 2014-2017. Все права защищены.</span>
                    </div>
                    <div class="footer__social">
                        <a href="#"><i class="fa fa-vk" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <div class="logIn hidden">

        <div class="logIn__close">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>

        <div class="forms"></div>
    </div>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}"></script>--}}
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?150"></script>
    <script type="text/javascript">VK.init({apiId: 5683855, onlyWidgets: true});</script>
    <script src="{{ url('static/js/libs.min.js') }}"></script>
    <script src="{{ url('static/js/common.js') }}"></script>
</body>
</html>
