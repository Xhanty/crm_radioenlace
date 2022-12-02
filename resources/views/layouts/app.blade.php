<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--- Favicon --->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/x-icon" />

    <!-- Bootstrap css -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" id="style" />

    <!--- Icons css --->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!--- Style css --->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet">

    <!--- Animations css --->
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
</head>

<body class="main-body bg-light  login-img">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('assets/img/loaders/loader-4.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- page -->
    <div class="page">
        <main class="my-auto page page-h">
            @yield('content')
        </main>
    </div>
    <!-- page closed -->
    <!-- /main-signin-wrapper -->

    <!--- JQuery min js --->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!--- Bootstrap Bundle js --->
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--- Ionicons js --->
    <script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>

    <!--- Moment js --->
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

    <!--- Eva-icons js --->
    <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>

    <!--themecolor js-->
    <script src="{{ asset('assets/js/themecolor.js') }}"></script>

    <!--- Custom js --->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!--- Login js --->
    <script src="{{ asset('assets/js/login.js') }}"></script>
</body>

</html>
