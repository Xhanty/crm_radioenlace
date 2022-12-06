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
    
    @yield('css')
</head>

<body class="main-body app sidebar-mini ltr">
    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('assets/img/loaders/loader-4.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /Loader -->

    <!-- page -->
    <div class="page custom-index">

        <!-- main-header -->
        <div class="main-header side-header sticky nav nav-item">
            <div class="container-fluid main-container ">
                <div class="main-header-left ">
                    <div class="app-sidebar__toggle mobile-toggle" data-bs-toggle="sidebar">
                        <a class="open-toggle" href="javascript:void(0);"><i class="header-icons"
                                data-eva="menu-outline"></i></a>
                        <a class="close-toggle" href="javascript:void(0);"><i class="header-icons"
                                data-eva="close-outline"></i></a>
                    </div>
                    <div class="responsive-logo">
                        <a href="#" class="header-logo"><img src="{{ asset('assets/img/brand/logo.png') }}"
                                class="logo-11"></a>
                        <a href="#" class="header-logo"><img src="{{ asset('assets/img/brand/logo-white.png') }}"
                                class="logo-1"></a>
                    </div>
                </div>
                <button class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                </button>
                <div
                    class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0  mg-lg-s-auto">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="main-header-right">
                            <li class="dropdown nav-item main-layout">
                                <a class="new theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                </a>
                            </li>
                            <div class="nav nav-item  navbar-nav-right mg-lg-s-auto">
                                <div class="nav-item full-screen fullscreen-button">
                                    <a class="new nav-link full-screen-link" href="javascript:void(0);"><i
                                            class="fe fe-maximize"></i></span></a>
                                </div>
                                <div class="dropdown main-profile-menu nav nav-item nav-link">
                                    <a class="profile-user d-flex" href=""><img
                                            src="{{ asset('assets/img/faces/6.jpg') }}" alt="user-img"
                                            class="rounded-circle mCS_img_loaded"><span></span></a>

                                    <div class="dropdown-menu">
                                        <div class="main-header-profile header-img">
                                            <div class="main-img-user"><img alt=""
                                                    src="{{ asset('assets/img/faces/6.jpg') }}"></div>
                                            <h6>Petey Cruiser</h6><span>Premium Member</span>
                                        </div>
                                        <a class="dropdown-item" href="#"><i class="far fa-user"></i> My
                                            Profile</a>
                                        <a class="dropdown-item" href="#"><i class="far fa-clock"></i>
                                            Activity Logs</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Sign
                                            Out</a>
                                    </div>
                                </div>
                                <div class="dropdown main-header-message right-toggle">
                                    <a class="nav-link pe-0" data-bs-toggle="sidebar-right"
                                        data-bs-target=".sidebar-right">
                                        <i class="ion ion-md-menu tx-20 bg-transparent"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /main-header -->

        <!-- main-sidebar -->
        <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
        <div class="sticky">
            <aside class="app-sidebar sidebar-scroll">
                <div class="main-sidebar-header active">
                    <a class="desktop-logo logo-light active" href="#"><img
                            src="{{ asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
                    <a class="desktop-logo logo-dark active" href="#"><img
                            src="{{ asset('assets/img/brand/logo-white.png') }}" class="main-logo"
                            alt="logo"></a>
                    <a class="logo-icon mobile-logo icon-light active" href="#"><img
                            src="{{ asset('assets/img/brand/favicon.png') }}" alt="logo"></a>
                    <a class="logo-icon mobile-logo icon-dark active" href="#"><img
                            src="{{ asset('assets/img/brand/favicon-white.png') }}" alt="logo"></a>
                </div>
                <div class="main-sidemenu">
                    <div class="main-sidebar-loggedin">
                        <div class="app-sidebar__user">
                            <div class="dropdown user-pro-body text-center">
                                <div class="user-pic">
                                    <img src="{{ asset('assets/img/faces/6.jpg') }}" alt="user-img"
                                        class="rounded-circle mCS_img_loaded">
                                </div>
                                <div class="user-info">
                                    <h6 class=" mb-0 text-dark">Petey Cruiser</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-navs">
                        <ul class="nav  nav-pills-circle" style="justify-content: center">
                            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Settings" aria-describedby="tooltip365540">
                                <a class="nav-link text-center m-2">
                                    <i class="fe fe-settings"></i>
                                </a>
                            </li>
                            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Followers">
                                <a class="nav-link text-center m-2">
                                    <i class="fe fe-user"></i>
                                </a>
                            </li>
                            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Logout">
                                <a class="nav-link text-center m-2">
                                    <i class="fe fe-power"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                            fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                        </svg></div>
                    <ul class="side-menu ">
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('home') }}"><i
                                    class="side-menu__icon fe fe-airplay"></i><span
                                    class="side-menu__label">Inicio</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-check"></i><span class="side-menu__label">Asignaciones</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="{{ route('asignaciones') }}">Mis Asignaciones</a></li>
                                <li><a class="slide-item" href="{{ route('gestionar_asignaciones') }}">Gestionar Asignaciones</a></li>
                                <li><a class="slide-item" href="{{ route('actividades_diarias') }}">Actividades Diarias</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-credit-card"></i><span class="side-menu__label">Puntos</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="{{ route('mis_puntos') }}">Mis Puntos</a></li>
                                <li><a class="slide-item" href="{{ route('gestionar_puntos') }}">Gestionar Puntos</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-truck"></i><span class="side-menu__label">Vehículos</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="{{ route('vehiculos') }}">Vehículos</a></li>
                                <li><a class="slide-item" href="{{ route('checklist_email') }}">Enviar Checklist Email</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('clientes') }}"><i
                                    class="side-menu__icon fe fe-user"></i><span
                                    class="side-menu__label">Clientes</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('empleados') }}"><i
                                    class="side-menu__icon fe fe-users"></i><span
                                    class="side-menu__label">Empleados</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('proveedores') }}"><i
                                    class="side-menu__icon fe fe-briefcase"></i><span
                                    class="side-menu__label">Proveedores</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-package"></i><span class="side-menu__label">Inventario</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="{{ route('categoria_productos') }}">Categorías</a></li>
                                <li><a class="slide-item" href="{{ route('almacenes') }}">Almacenes</a></li>
                                <li><a class="slide-item" href="{{ route('inventario') }}">Productos / Stock</a></li>
                                <li><a class="slide-item" href="{{ route('actividades_inventario') }}">Actividades Inventario</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-shopping-cart"></i><span class="side-menu__label">Movimiento Inv.</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="#">Productos Baja</a></li>
                                <li><a class="slide-item" href="#">Repuestos Reparación</a></li>
                                <li><a class="slide-item" href="#">Productos Instalados</a></li>
                                <li><a class="slide-item" href="#">Ventas</a></li>
                                <li><a class="slide-item" href="#">Prestamos</a></li>
                                <li><a class="slide-item" href="#">Alquileres</a></li>
                                <li><a class="slide-item" href="#">Productos Asignados</a></li>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" href="#"><i
                                    class="side-menu__icon fe fe-sliders"></i><span
                                    class="side-menu__label">Solicitudes Inventario</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('proyectos') }}"><i
                                    class="side-menu__icon fe fe-shield"></i><span
                                    class="side-menu__label">Proyectos</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-bar-chart"></i><span class="side-menu__label">Seguimiento Clientes</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="#">Categorías</a></li>
                                <li><a class="slide-item" href="#">Seguimientos</a></li>
                                <li><a class="slide-item" href="#">Mis Tarjetas</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('reparaciones') }}"><i
                                    class="side-menu__icon fe fe-layers"></i><span
                                    class="side-menu__label">Reparaciones</span></a>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-folder"></i><span class="side-menu__label">Documentos</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="#">Categorías Archivos</a></li>
                                <li><a class="slide-item" href="#">Gestionar Archivos</a></li>
                                <li><a class="slide-item" href="#">Clientes</a></li>
                                <li><a class="slide-item" href="#">Gerencia</a></li>
                                <li><a class="slide-item" href="#">Subgerencia</a></li>
                                <li><a class="slide-item" href="#">Contabilidad</a></li>
                                <li><a class="slide-item" href="#">Cartera</a></li>
                                <li><a class="slide-item" href="#">Tesorería</a></li>
                                <li><a class="slide-item" href="#">RH</a></li>
                                <li><a class="slide-item" href="#">Coordinador Comercial</a></li>
                                <li><a class="slide-item" href="#">Gerente Comercial</a></li>
                                <li><a class="slide-item" href="#">Laboratorio</a></li>
                                <li><a class="slide-item" href="#">SST</a></li>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-file-text"></i><span class="side-menu__label">Comercial</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="#">Ordenes Compra</a></li>
                                <li><a class="slide-item" href="#">Cotizaciones</a></li>
                                <li><a class="slide-item" href="#">Remisiones</a></li>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-dollar-sign"></i><span class="side-menu__label">Contabilidad</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="#">Facturación</a></li>
                                <li><a class="slide-item" href="#">Estadísticas</a></li>
                                <li><a class="slide-item" href="#">Gestionar Viáticos</a></li>
                                <li><a class="slide-item" href="#">Gestionar Causaciones</a></li>
                                <li><a class="slide-item" href="#">Informes Contables</a></li>
                                <li><a class="slide-item" href="#">Nómina</a></li>
                                <li><a class="slide-item" href="#">Configuración Nómina</a></li>
                            </ul>
                        </li>

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-globe"></i><span class="side-menu__label">Gastos</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="#">Arrendamientos</a></li>
                                <li><a class="slide-item" href="#">Gastos Varios</a></li>
                                <li><a class="slide-item" href="#">Gastos Fijos</a></li>
                                <li><a class="slide-item" href="#">Gastos Equivalentes</a></li>
                            </ul>
                        </li>
                    </ul>

                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                        </svg></div>
                </div>
            </aside>
        </div>
        <!-- main-sidebar -->

        <div class="main-content app-content">
            @yield('content')
        </div>

        <!--Sidebar-right-->
        <div class="sidebar sidebar-right sidebar-animate">
            <div class="panel panel-primary card mb-0">
                <div class="panel-body tabs-menu-body p-0 border-0">
                    <ul class="Date-time">
                        <li class="time">
                            <h1 class="animated ">21:00</h1>
                            <p class="animated ">Sat,October 1st 2029</p>
                        </li>
                    </ul>
                    <div class="card-body latest-tasks">
                        <h3 class="events-title"><span>Eventos </span></h3>
                        <div class="event">
                            <div class="Day">Wednessday 22 Jan</div>
                            <div class="tasks">
                                <div class=" task-line primary">
                                    <a href="javascript:void(0);" class="label">
                                        XML Import &amp; Export
                                    </a>
                                    <div class="time">
                                        12:00 PM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Sidebar-right-->

        <!-- Footer opened -->
        <div class="main-footer ht-45">
            <div class="container-fluid pd-t-0-f ht-100p">
                <span> Copyright © 2022 <a href="javascript:void(0);" class="text-primary">Radio Enlace</a>.</span>
            </div>
        </div>
        <!-- Footer closed -->
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
    <script src="../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="../assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="../assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="../assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="../assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--- Menu js --->
    <script src="{{ asset('assets/js/app/menu.js') }}"></script>
    @yield('scripts')
</body>

</html>
