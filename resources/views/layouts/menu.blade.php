<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

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
                                src="{{ asset('assets/img/brand/logo.png') }}" class="logo-1"></a>
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
                                <!--<div class="nav-item full-screen fullscreen-button">
                                    <a class="new nav-link full-screen-link" href="javascript:void(0);"><i
                                            class="fe fe-maximize"></i></span></a>
                                </div>-->
                                <div class="nav-item full-screen" style="margin: auto 0;">
                                    <a class="new nav-link full-screen-link" title="Actas Reuniones"
                                        href="{{ route('actas_reuniones') }}"><i
                                            class="fe fe-file-text"></i></span></a>
                                </div>
                                <div class="nav-item full-screen" style="margin: auto 0;">
                                    <a class="new nav-link full-screen-link" target="_BLANK" title="Calendario"
                                        href="{{ route('calendario') }}"><i class="fe fe-calendar"></i></span></a>
                                </div>
                                <div class="dropdown main-profile-menu nav nav-item nav-link">
                                    <a class="profile-user d-flex" href=""><img
                                            src="{{ asset('images/empleados/' . session('user_img')) }}" alt="user-img"
                                            class="rounded-circle mCS_img_loaded"><span></span></a>

                                    <div class="dropdown-menu">
                                        <div class="main-header-profile header-img">
                                            <div class="main-img-user"><img alt=""
                                                    src="{{ asset('images/empleados/' . session('user_img')) }}">
                                            </div>
                                            <h6 class="name_user_val text-center">Petey Cruiser</h6><span
                                                class="cargo_user_val">Premium Member</span>
                                        </div>
                                        <a class="dropdown-item" href="javascript:void(0)"><i
                                                class="far fa-user"></i>
                                            Mi Perfil</a>
                                        <a class="dropdown-item btn_logout_sesion" href="javascript:void(0)"><i
                                                class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                                    </div>
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
                            @if (auth()->user()->hasPermissionTo('categorias_calendario'))
                                <li class="nav-item" title="Categorias Calendario">
                                    <a class="nav-link text-center m-2" href="{{ route('categorias_calendario') }}">
                                        <i class="fe fe-calendar"></i>
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

                        @if (auth()->user()->hasPermissionTo('gestion_documentos'))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('documentos') }}"><i
                                        class="side-menu__icon fe fe-folder"></i><span
                                        class="side-menu__label">Documentos</span></a>
                            </li>
                        @endif

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-file-text"></i><span class="side-menu__label">Gestión
                                    Calidad</span><i class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <li><a class="slide-item" href="javascript:void(0);">DOFA</a>
                                <li><a class="slide-item" href="javascript:void(0);">Normas</a>
                                <li><a class="slide-item" href="javascript:void(0);">Políticas</a>
                                <li><a class="slide-item" href="javascript:void(0);">Mapa Procesos</a>
                                </li>
                            </ul>
                        </li>

                        @if (auth()->user()->hasPermissionTo('solicitud_elementos'))
                            <li class="slide">
                                <a class="side-menu__item" href="{{ route('solicitud_inventario') }}"><i
                                        class="side-menu__icon fe fe-sliders"></i><span
                                        class="side-menu__label">Solicitudes Inventario</span></a>
                            </li>
                        @endif

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

                        @if (auth()->user()->hasPermissionToMultiple(
                                    'gestion_orden_compra|' .
                                        'gestionar_cotizaciones|' .
                                        'gestionar_remisiones|' .
                                        'gestionar_precios_proveedores|' .
                                        'ver_prospectos_personas|' .
                                        'ver_remisiones|' .
                                        'ver_prospectos_empresas'))
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
                                    @if (auth()->user()->hasPermissionTo('gestionar_remisiones') ||
                                            auth()->user()->hasPermissionTo('ver_remisiones'))
                                        <li><a class="slide-item" href="{{ route('remisiones') }}">Remisiones</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestionar_precios_proveedores'))
                                        <li><a class="slide-item" href="{{ route('precios_proveedores') }}">Precios
                                                Proveedores</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('ver_prospectos_personas'))
                                        <li><a class="slide-item" href="{{ route('prospectos_bd') }}">Prospectos
                                                Personas</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('ver_prospectos_empresas'))
                                        <li><a class="slide-item"
                                                href="{{ route('prospectos_empresas_bd') }}">Prospectos Empresas</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple(
                                    'contabilidad_config_administrativa|' .
                                        'contabilidad_config_general|' .
                                        'contabilidad_config_catalogos|' .
                                        'contabilidad_config_otros|' .
                                        'contabilidad_factura_compra|' .
                                        'contabilidad_factura_venta|' .
                                        'contabilidad_nota_credito|' .
                                        'contabilidad_nota_debito|' .
                                        'contabilidad_recibo_pago'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-dollar-sign"></i><span
                                        class="side-menu__label">Contabilidad</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionToMultiple(
                                                'contabilidad_config_administrativa|contabilidad_config_general|contabilidad_config_catalogos|contabilidad_config_otros'))
                                        <li><a class="slide-item"
                                                href="{{ route('configuracion_contabilidad') }}">Configuración</a>
                                        </li>
                                        <li><a class="slide-item"
                                            href="{{ route('conciliacion_bancaria') }}">Conciliación Bancaría</a>
                                        </li>
                                        <li><a class="slide-item"
                                            href="{{ route('comprobantes_contables') }}">Comprobantes Contables</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionToMultiple(
                                                'contabilidad_factura_compra|contabilidad_factura_venta|contabilidad_nota_credito|contabilidad_nota_debito|contabilidad_recibo_pago'))
                                        <li class="sub-slide">
                                            <a class="slide-item" data-bs-toggle="sub-slide"
                                                href="javascript:void(0);"><span
                                                    class="sub-side-menu__label">Compras</span><i
                                                    class="sub-angle fe fe-chevron-down"></i></a>
                                            <ul class="sub-slide-menu" style="display: none;"
                                                id="2_1_otro_asignaciones">
                                                @if (auth()->user()->hasPermissionTo('contabilidad_factura_compra'))
                                                    <li><a class="sub-side-menu__item"
                                                            href="{{ route('factura_compra') }}">Facturación</a>
                                                    </li>
                                                    <!--<li><a class="sub-side-menu__item" href="javascript:void(0);">Nota
                                                        Crédito</a>
                                                </li>
                                                <li><a class="sub-side-menu__item" href="javascript:void(0);">Nota
                                                        Débito</a>
                                                </li>-->
                                                    <li><a class="sub-side-menu__item"
                                                            href="{{ route('comprobantes_egresos') }}">Comprobante
                                                            Egreso</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </li>
                                        <li class="sub-slide">
                                            <a class="slide-item" data-bs-toggle="sub-slide"
                                                href="javascript:void(0);"><span
                                                    class="sub-side-menu__label">Ventas</span><i
                                                    class="sub-angle fe fe-chevron-down"></i></a>
                                            <ul class="sub-slide-menu" style="display: none;"
                                                id="2_1_otro_asignaciones">
                                                @if (auth()->user()->hasPermissionTo('contabilidad_factura_venta'))
                                                    <li><a class="sub-side-menu__item"
                                                            href="{{ route('factura_venta') }}">Facturación</a>
                                                    </li>
                                                @endif
                                                <!--@if (auth()->user()->hasPermissionTo('contabilidad_nota_credito'))
<li><a class="sub-side-menu__item" href="javascript:void(0);">Nota
                                                            Crédito</a>
                                                    </li>
@endif
                                                @if (auth()->user()->hasPermissionTo('contabilidad_nota_debito'))
<li><a class="sub-side-menu__item" href="javascript:void(0);">Nota
                                                            Débito</a>
                                                    </li>
@endif-->
                                                @if (auth()->user()->hasPermissionTo('contabilidad_recibo_pago'))
                                                    <li><a class="sub-side-menu__item"
                                                            href="{{ route('recibos_pagos') }}">Recibo Caja</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </li>
                                    @endif
                                    <!--<li><a class="slide-item" href="{{ route('config_nomina') }}">Configuración Nómina</a></li>-->
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple(
                                    'gestion_categorias_inventario|' .
                                        'gestion_almacenes_inventario|' .
                                        'gestion_productos_inventario|' .
                                        'gestion_inventario|' .
                                        'gestion_solicitudes|' .
                                        'ver_movimientos_inventario'))
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
                                        <li><a class="slide-item" href="{{ route('gestion_inventario') }}">Inventario
                                                /
                                                Stock</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('gestion_solicitudes'))
                                        <li><a class="slide-item"
                                                href="{{ route('gestion_solicitudes') }}">Solicitudes</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('ver_movimientos_inventario'))
                                        <li><a class="slide-item"
                                                href="{{ route('gestion_solicitudes') }}">Movimientos</a>
                                        </li>
                                    @endif
                                </ul>
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

                        @if (auth()->user()->hasPermissionToMultiple('ver_reparaciones_asignadas|' . 'gestion_reparaciones'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-layers"></i><span
                                        class="side-menu__label">Reparaciones</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('gestion_reparaciones'))
                                        <li><a class="slide-item"
                                                href="{{ route('accesorios_reparaciones') }}">Accesorios</a>
                                        </li>
                                        <li><a class="slide-item"
                                                href="{{ route('categorias_reparaciones') }}">Categorías</a>
                                        </li>
                                        <li><a class="slide-item" href="{{ route('reparaciones') }}">Gestionar
                                                Reparaciones</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('ver_reparaciones_asignadas'))
                                        <li><a class="slide-item" href="{{ route('mis_reparaciones') }}">Reparaciones
                                                Asignadas</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                    class="side-menu__icon fe fe-map"></i><span
                                    class="side-menu__label">Viáticos</span><i
                                    class="angle fe fe-chevron-down"></i></a>
                            <ul class="slide-menu">
                                <!--<li><a class="slide-item" href="{{ route('config_viaticos') }}">Configuración</a>
                                </li>-->
                                <li><a class="slide-item" href="{{ route('visitas_viaticos') }}">Visitas</a>
                                </li>
                                <li><a class="slide-item" href="{{ route('viaticos') }}">Viáticos</a>
                                </li>
                            </ul>
                        </li>

                        @if (auth()->user()->hasPermissionToMultiple('contabilidad_config_administrativa'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-bar-chart-2"></i><span
                                        class="side-menu__label">Reportes</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    <li class="sub-slide">
                                        <a class="slide-item" data-bs-toggle="sub-slide"
                                            href="javascript:void(0);"><span
                                                class="sub-side-menu__label">Contabilidad</span><i
                                                class="sub-angle fe fe-chevron-down"></i></a>
                                        <ul class="sub-slide-menu" style="display: none;" id="2_1_otro_asignaciones">
                                            <li><a class="sub-side-menu__item"
                                                    href="{{ route('reporte_compras') }}">Compras</a>
                                            </li>
                                            <li><a class="sub-side-menu__item"
                                                href="{{ route('reporte_ventas') }}">Ventas</a>
                                            </li>
                                            <li><a class="sub-side-menu__item"
                                                    href="{{ route('reporte_gastos_fijos') }}">Gastos Fijos</a>
                                            </li>
                                            <li><a class="sub-side-menu__item"
                                                href="{{ route('reporte_resultado_integral') }}">Estado de resultado integral</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="sub-slide">
                                        <a class="slide-item" data-bs-toggle="sub-slide"
                                            href="javascript:void(0);"><span
                                                class="sub-side-menu__label">Retenciones</span><i
                                                class="sub-angle fe fe-chevron-down"></i></a>
                                        <ul class="sub-slide-menu" style="display: none;" id="2_1_otro_asignaciones">
                                            <li><a class="sub-side-menu__item"
                                                    href="{{ route('reporte_compras') }}">Clientes</a>
                                            </li>
                                            <li><a class="sub-side-menu__item" target="_blank"
                                                    href="http://127.0.0.1:8000/retenciones.xlsx">Proveedores</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple('ver_clientes|' . 'ver_empleados|' . 'ver_proveedores'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-users"></i><span
                                        class="side-menu__label">Terceros</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('ver_clientes'))
                                        <li><a class="slide-item" href="{{ route('terceros') }}">Clientes</a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('ver_empleados'))
                                        <li><a class="slide-item" href="{{ route('empleados') }}">Empleados</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('ver_proveedores'))
                                        <li><a class="slide-item" href="{{ route('proveedores') }}">Proveedores</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (auth()->user()->hasPermissionToMultiple('ver_vehiculos|' . 'enviar_checklist_vehiculos'))
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i
                                        class="side-menu__icon fe fe-truck"></i><span
                                        class="side-menu__label">Vehículos</span><i
                                        class="angle fe fe-chevron-down"></i></a>
                                <ul class="slide-menu">
                                    @if (auth()->user()->hasPermissionTo('ver_vehiculos'))
                                        <li><a class="slide-item" href="{{ route('vehiculos') }}">Vehículos</a></li>
                                    @endif
                                    @if (auth()->user()->hasPermissionTo('enviar_checklist_vehiculos'))
                                        <li><a class="slide-item" href="{{ route('checklist_email') }}">Enviar
                                                Checklist
                                                Email</a></li>
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
                <span> Copyright © 2023 <a href="javascript:void(0);" class="text-primary">Radio Enlace</a>.</span>
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

    <!--- Moment js --->
    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

    <!--- Chart bundle min js --->
    <script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

    <!--- JQuery sparkline js --->
    <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <!--- Internal Sampledata js --->
    <script src="{{ asset('assets/js/chart.flot.sampledata.js') }}"></script>

    <!--- Eva-icons js --->
    <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>

    <!--- Select2 js --->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

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

    <!--- Date Range --->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!--- Menu js --->
    <script src="{{ asset('assets/js/app/menu.js') }}"></script>

    <!--- Notificaciones -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
    <script>
        Push.Permission.request();

        var notification_bienvenida = localStorage.getItem('notification_bienvenida');

        if (!notification_bienvenida) {
            Push.create("CRM", {
                body: "Bienvenido(a), recuerda revisar las asignaciones",
                icon: 'http://radioenlacesas.com/wp-content/uploads/2017/08/cropped-logoradioenlace-2.png',
                timeout: 8000,
                vibrate: [100, 100, 100],
                onClick: function() {
                    window.focus();
                    this.close();
                }
            });
        }

        localStorage.setItem('notification_bienvenida', 1);
    </script>

    <script src="{{ asset('assets/js/app/notificaciones/calendario.js') }}"></script>

    <!--- Custom js --->
    @yield('scripts')
</body>

</html>
