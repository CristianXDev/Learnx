<!DOCTYPE html>
<html lang="es" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <!--META-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--TITLE-->
    @yield('title')

    <!-- FAVICON -->
    <link rel="icon" type="image/x-icon" href="{{asset('static/assets/img/favicon/favicon.ico')}}" />
    <!--STYLE-->
    <link rel="stylesheet" href="{{ asset('static/css/shorthand.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('static/css/css.css')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:200,300,400,500,600,700,800,900&display=swap"/>
    <link rel="stylesheet" type="text/css"
    href="{{ asset('static/css/slick.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/css/slick-theme.css')}}" />

</head>

<body class="bg-black muli">

    @include('partials.home.navbar')

    @yield('content')

    <script src="{{ asset('static/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('static/js/feather.min.js')}}"></script>
    <script src="{{ asset('static/js/slick.min.js')}}"></script>
    <script src="{{ asset('static/js/smooth-scroll.polyfills.min.js')}}"></script>
    <script src="{{ asset('static/assets/js/script.js')}} "></script>
    
    <!--Validate JS-->
    <script src="{{asset('static/js/validate.js')}}"></script>
</body>

</html>