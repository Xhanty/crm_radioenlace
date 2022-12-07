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

    <!--- Animations css --->
    <link href="{{ asset('assets/css/new_css.css') }}" rel="stylesheet">

    <!--- Toastr css --->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>

<body class="main-body login-img light-menu gradient-header">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('assets/img/loaders/loader-4.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- page -->
    <div class="page">

        <div class="main-error-wrapper  page page-h ">
            @yield('content')
        </div>

    </div>
    <!-- page closed -->
    <!-- /main-signin-wrapper -->

    <!--- Back-to-top --->
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

    <!--- JQuery min js --->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <!--- Datepicker js --->
    <script src="{{ asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

    <!--- Bootstrap Bundle js --->
    <script src="{{ asset('assets/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--- Ionicons js --->
    <script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>

    <!--- Chart bundle min js --->
    <script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

    <!--- JQuery sparkline js --->
    <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!--- Internal Sampledata js --->
    <script src="{{ asset('assets/js/chart.flot.sampledata.js') }}"></script>

    <!--- Eva-icons js --->
    <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>

    <!--- Moment js --->
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

    <!--- Perfect-scrollbar js --->
    <script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>

    <!--- Sidebar js --->
    <script src="{{ asset('assets/plugins/side-menu/sidemenu.js') }}"></script>

    <!--- sticky js --->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- right-sidebar js -->
    <script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>
    <script src="{{ asset('assets/plugins/sidebar/sidebar-custom.js') }}"></script>

    <!-- Morris js -->
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris.js/morris.min.js') }}"></script>

    <!--- Scripts js --->
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <!--- Index js --->
    <script src="{{ asset('assets/js/index.js') }}"></script>

    <!--themecolor js-->
    <script src="{{ asset('assets/js/themecolor.js') }}"></script>

    <!--swither-styles js-->
    <script src="{{ asset('assets/js/swither-styles.js') }}"></script>

    <!--- Custom js --->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--- Select2 js --->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
</body>

</html>
