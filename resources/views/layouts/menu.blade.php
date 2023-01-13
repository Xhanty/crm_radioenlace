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

    <!--- Date Range --->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    @yield('css')
</head>
<style>
    .slide.is-expanded .sub-side-menu__item:before {
        content: "\e994";
    }
</style>

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
                        <a href="javascript:void(0)" class="header-logo"><img
                                src="{{ asset('assets/img/brand/logo.png') }}" class="logo-11"></a>
                        <a href="javascript:void(0)" class="header-logo"><img
                                src="{{ asset('assets/img/brand/logo-white.png') }}" class="logo-1"></a>
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
                                    <!--<span class="dark-layout"><i class="fe fe-moon"></i></span>-->
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
                                            src="{{ asset('images/empleados/' . session('user_img')) }}" alt="user-img"
                                            class="rounded-circle mCS_img_loaded"><span></span></a>

                                    <div class="dropdown-menu">
                                        <div class="main-header-profile header-img">
                                            <div class="main-img-user"><img alt=""
                                                    src="{{ asset('images/empleados/' . session('user_img')) }}"></div>
                                            <h6 class="name_user_val">Petey Cruiser</h6><span
                                                class="cargo_user_val">Premium Member</span>
                                        </div>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="far fa-user"></i>
                                            Mi Perfil</a>
                                        <a class="dropdown-item btn_logout_sesion" href="javascript:void(0)"><i
                                                class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                                    </div>
                                </div>
                                <div class="nav-item full-screen" style="margin: auto 0;">
                                    <a class="new nav-link full-screen-link" target="_BLANK"
                                        href="{{ route('calendario') }}"><i class="fe fe-calendar"></i></span></a>
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
                    <a class="desktop-logo logo-light active" href="javascript:void(0)"><img
                            src="{{ asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
                    <a class="desktop-logo logo-dark active" href="javascript:void(0)"><img
                            src="{{ asset('assets/img/brand/logo-white.png') }}" class="main-logo"
                            alt="logo"></a>
                    <a class="logo-icon mobile-logo icon-light active" href="javascript:void(0)"><img
                            src="{{ asset('assets/img/brand/favicon.png') }}" alt="logo"></a>
                    <a class="logo-icon mobile-logo icon-dark active" href="javascript:void(0)"><img
                            src="{{ asset('assets/img/brand/favicon-white.png') }}" alt="logo"></a>
                </div>
                <div class="main-sidemenu">
                    <div class="main-sidebar-loggedin">
                        <div class="app-sidebar__user">
                            <div class="dropdown user-pro-body text-center">
                                <div class="user-pic">
                                    <img src="{{ asset('images/empleados/' . session('user_img')) }}" alt="user-img"
                                        class="rounded-circle mCS_img_loaded">
                                </div>
                                <div class="user-info">
                                    <h6 class=" mb-0 text-dark name_user_val">Petey Cruiser</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-navs">
                        <ul class="nav  nav-pills-circle" style="justify-content: center">
                            @if (auth()->user()->hasPermissionTo('permisos_usuarios'))
                                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Settings" aria-describedby="tooltip365540">
                                    <a class="nav-link text-center m-2" href="{{ route('permisos') }}">
                                        <i class="fe fe-settings"></i>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Followers">
                                <a class="nav-link text-center m-2" href="javascript:void(0)">
                                    <i class="fe fe-user"></i>
                                </a>
                            </li>
                            <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="Logout">
                                <a class="nav-link text-center m-2 btn_logout_sesion" href="javascript:void(0)">
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

                        <li class="slide" id="menu_otro_asignaciones">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-check"></i><span
                                    class="side-menu__label">Asignaciones</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu" style="display: none;" id="1_otro_asignaciones">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Asignaciones</a></li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span
                                            class="sub-side-menu__label">Generales</span><i
                                            class="sub-angle fe fe-chevron-down"></i></a>
                                    <ul class="sub-slide-menu" style="display: none;" id="2_1_otro_asignaciones">
                                        <li><a class="sub-side-menu__item"
                                                href="{{ route('asignaciones_clientes') }}">Asignaciones</a></li>
                                        @if (auth()->user()->hasPermissionTo('gestion_asignacion'))
                                            <li><a class="sub-side-menu__item"
                                                    href="{{ route('gestionar_asignaciones_clientes') }}">Gestionar
                                                    Asignaciones</a></li>
                                        @endif
                                    </ul>
                                </li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span
                                            class="sub-side-menu__label">Proyectos</span><i
                                            class="sub-angle fe fe-chevron-down"></i></a>
                                    <ul class="sub-slide-menu" style="display: none;" id="1_1_otro_asignaciones">
                                        <li><a class="sub-side-menu__item"
                                                href="{{ route('asignaciones') }}">Asignaciones</a></li>
                                        @if (auth()->user()->hasPermissionTo('gestion_asignaciones_proyectos'))
                                            <li><a class="sub-side-menu__item"
                                                    href="{{ route('gestionar_asignaciones') }}">Gestionar
                                                    Asignaciones</a></li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!--<li class="slide">
                            <a class="side-menu__item" href="{{ route('actividades_diarias') }}"><i
                                    class="side-menu__icon fe fe-user"></i><span class="side-menu__label">Actividades
                                    Diarias</span></a>
                        </li>-->

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-credit-card"></i><span
                                    class="side-menu__label">Puntos</span><i class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="{{ route('mis_puntos') }}">Mis Puntos</a></li>
                                @if (auth()->user()->hasPermissionTo('gestionar_puntos'))
                                    <li><a class="slide-item" href="{{ route('gestionar_puntos') }}">Gestionar
                                            Puntos</a>
                                    </li>
                                @endif
                            </ul>
                        </li>

                        @if (auth()->user()->hasPermissionTo('ver_vehiculos'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-truck"></i><span
                                        class="side-menu__label">Vehículos</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li><a class="slide-item" href="{{ route('vehiculos') }}">Vehículos</a></li>
                                    @if (auth()->user()->hasPermissionTo('gestion_checklist_vehiculos'))
                                        <li><a class="slide-item" href="{{ route('checklist_email') }}">Enviar
                                                Checklist
                                                Email</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionTo('ver_clientes'))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('clientes') }}"><i
                                        class="side-menu__icon fe fe-user"></i><span
                                        class="side-menu__label">Clientes</span></a>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionTo('ver_empleados'))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('empleados') }}"><i
                                        class="side-menu__icon fe fe-users"></i><span
                                        class="side-menu__label">Empleados</span></a>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionTo('ver_proveedores'))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('proveedores') }}"><i
                                        class="side-menu__icon fe fe-briefcase"></i><span
                                        class="side-menu__label">Proveedores</span></a>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple(
                                'gestion_categorias_inventario|' .
                                    'gestion_almacenes_inventario|' .
                                    'gestion_productos_inventario|' .
                                    'gestion_inventario|' .
                                    'gestion_actividades_inventario'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-package"></i><span
                                        class="side-menu__label">Inventario</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gestion_almacenes_inventario'))
                                        <li><a class="slide-item" href="{{ route('almacenes') }}">Almacenes</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_categorias_inventario'))
                                        <li><a class="slide-item"
                                                href="{{ route('categoria_productos') }}">Categorías</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_productos_inventario'))
                                        <li><a class="slide-item" href="{{ route('inventario') }}">Productos</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_inventario'))
                                        <li><a class="slide-item"
                                                href="{{ route('gestion_inventario') }}">Inventario /
                                                Stock</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_actividades_inventario'))
                                        <li><a class="slide-item"
                                                href="{{ route('actividades_inventario') }}">Actividades
                                                Inventario</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple(
                                'gestion_productos_baja|' .
                                    'gestion_repuestos_reparacion|' .
                                    'gestion_ventas|' .
                                    'gestion_prestamos|' .
                                    'gestion_alquileres|' .
                                    'gestion_productos_asignados|' .
                                    'gestion_productos_instalados'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-shopping-cart"></i><span
                                        class="side-menu__label">Movimiento Inv.</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gestion_productos_baja'))
                                        <li><a class="slide-item" href="{{ route('productos_baja') }}">Productos
                                                Baja</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_repuestos_reparacion'))
                                        <li><a class="slide-item"
                                                href="{{ route('repuestos_reparacion') }}">Repuestos
                                                Reparación</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_productos_instalados'))
                                        <li><a class="slide-item"
                                                href="{{ route('productos_instalados') }}">Productos
                                                Instalados</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_ventas'))
                                        <li><a class="slide-item" href="{{ route('ventas') }}">Ventas</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_prestamos'))
                                        <li><a class="slide-item" href="{{ route('prestamos') }}">Prestamos</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_alquileres'))
                                        <li><a class="slide-item" href="{{ route('alquileres') }}">Alquileres</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_productos_asignados'))
                                        <li><a class="slide-item" href="{{ route('productos_asignados') }}">Productos
                                                Asignados</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionTo('gestion_solicitudes'))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('solicitud_inventario') }}"><i
                                        class="side-menu__icon fe fe-sliders"></i><span
                                        class="side-menu__label">Solicitudes Inventario</span></a>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple('gesion_categorias_proyectos|' . 'gestion_proyectos'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-shield"></i><span
                                        class="side-menu__label">Proyectos</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gesion_categorias_proyectos'))
                                        <li><a class="slide-item"
                                                href="{{ route('categorias_proyectos') }}">Categorías</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_proyectos'))
                                        <li><a class="slide-item" href="{{ route('proyectos') }}">Proyectos</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple('gestion_categorias_seguimientos|' . 'gestion_seguimientos'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-bar-chart"></i><span
                                        class="side-menu__label">Seguimiento Clientes</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gestion_categorias_seguimientos'))
                                        <li><a class="slide-item"
                                                href="{{ route('categorias_seguimientos') }}">Categorías</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_seguimientos'))
                                        <li><a class="slide-item"
                                                href="{{ route('seguimientos_clientes') }}">Seguimientos</a></li>
                                    @endif
                                    <!--<li><a class="slide-item" href="{{ route('tarjetas_seguimientos') }}">Mis
                                        Tarjetas</a></li>-->
                                </ul>
                            </li>
                        @endif

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-layers"></i><span
                                    class="side-menu__label">Reparaciones</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                @if (auth()->user()->hasPermissionTo('gestion_reparaciones'))
                                    <li><a class="slide-item" href="{{ route('reparaciones') }}">Reparaciones</a>
                                    </li>
                                @endif
                                <li><a class="slide-item" href="{{ route('mis_reparaciones') }}">Reparaciones
                                        Asignadas</a></li>
                            </ul>
                        </li>

                        @if (auth()->user()->hasPermissionToMultiple('gestion_categorias_documentos|' . 'gestion_archivos|' . 'gestion_documentos'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-folder"></i><span
                                        class="side-menu__label">Documentos</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gestion_categorias_documentos'))
                                        <li><a class="slide-item"
                                                href="{{ route('categorias_archivos') }}">Categorías
                                                Documentos</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_archivos'))
                                        <li><a class="slide-item" href="{{ route('archivos') }}">Gestionar
                                                Archivos</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_documentos'))
                                        <li><a class="slide-item" href="{{ route('documentos') }}">Documentos</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple('gestion_orden_compra|' . 'gestionar_cotizaciones|' . 'gestionar_remisiones'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-file-text"></i><span
                                        class="side-menu__label">Comercial</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gestion_orden_compra'))
                                        <li><a class="slide-item" href="{{ route('ordenes_compra') }}">Ordenes
                                                Compra</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestionar_cotizaciones'))
                                        <li><a class="slide-item" href="{{ route('cotizaciones') }}">Cotizaciones</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestionar_remisiones'))
                                        <li><a class="slide-item" href="{{ route('remisiones') }}">Remisiones</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple(
                                'gestion_facturacion|' .
                                    'gestion_causaciones|' .
                                    'estadistica_proveedores|' .
                                    'estadisticas_ventas|' .
                                    'estadisticas_orden_compra|' .
                                    'informes_contables|' .
                                    'gestion_viaticos|' .
                                    'gestion_nomina_general|' .
                                    'gestion_config_nomina_general'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-dollar-sign"></i><span
                                        class="side-menu__label">Contabilidad</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gestion_facturacion'))
                                        <li><a class="slide-item" href="{{ route('facturacion') }}">Facturación</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('estadistica_proveedores'))
                                        <li><a class="slide-item"
                                                href="{{ route('estadistica_proveedores') }}">Estadística
                                                Proveedores</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('estadisticas_orden_compra'))
                                        <li><a class="slide-item"
                                                href="{{ route('estadistica_compra') }}">Estadística
                                                Compra</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('estadisticas_ventas'))
                                        <li><a class="slide-item"
                                                href="{{ route('estadistica_ventas') }}">Estadística
                                                Ventas</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_viaticos'))
                                        <li><a class="slide-item" href="{{ route('viaticos') }}">Gestionar
                                                Viáticos</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_causaciones'))
                                        <li><a class="slide-item" href="{{ route('causaciones') }}">Gestionar
                                                Causaciones</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('informes_contables'))
                                        <li><a class="slide-item" href="{{ route('informe_contable') }}">Informes
                                                Contables</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_nomina_general'))
                                        <li><a class="slide-item" href="{{ route('nomina') }}">Nómina</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_config_nomina_general'))
                                        <li><a class="slide-item" href="{{ route('config_nomina') }}">Configuración
                                                Nómina</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple(
                                'gestion_arrendamientos|' . 'gestion_gastos_varios|' . 'gestion_gastos_fijos|' . 'gestion_gastos_equivalentes'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-globe"></i><span
                                        class="side-menu__label">Gastos</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gestion_arrendamientos'))
                                        <li><a class="slide-item"
                                                href="{{ route('arrendamientos') }}">Arrendamientos</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_gastos_varios'))
                                        <li><a class="slide-item" href="{{ route('gastos_varios') }}">Gastos
                                                Varios</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_gastos_fijos'))
                                        <li><a class="slide-item" href="{{ route('gastos_fijos') }}">Gastos Fijos</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_gastos_equivalentes'))
                                        <li><a class="slide-item" href="{{ route('gastos_equivalentes') }}">Gastos
                                                Equivalentes</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
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
    <!--<script src="{{ asset('assets/plugins/perfect-scrollbar/p-scroll.js') }}"></script>-->

    <!--- Sidebar js --->
    <script src="{{ asset('assets/plugins/side-menu/sidemenu.js') }}"></script>

    <!--- sticky js --->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- right-sidebar js -->
    <!--<script src="{{ asset('assets/plugins/sidebar/sidebar.js') }}"></script>
    <script src="{{ asset('assets/plugins/sidebar/sidebar-custom.js') }}"></script>-->

    <!-- Morris js -->
    <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris.js/morris.min.js') }}"></script>

    <!--- Scripts js --->
    <!--<script src="{{ asset('assets/js/script.js') }}"></script>-->

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
    <!--- Date Range --->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!--- Menu js --->
    <script src="{{ asset('assets/js/app/menu.js') }}"></script>

    <!--- Custom js --->
    @yield('scripts')
</body>

</html>
