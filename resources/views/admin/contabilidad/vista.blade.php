@extends('layouts.menu')

@section('css')
    <style>
        .bg-info {
            background: linear-gradient(45deg, rgb(156, 156, 156), #DA251D) !important;
        }

        .box {
            margin-top: 20px;
        }

        .box:hover {
            box-shadow: 0px 30px 40px -20px hsl(229, 31%, 21%);
            transform: scale(1.05);
            /* Escala ligeramente el elemento al hacer hover */
            transition: transform 0.3s ease;
            /* Agrega una transición suave */
        }

        /* También puedes aplicar animaciones específicas a elementos dentro del card en hover, por ejemplo: */

        .box:hover img {
            transform: rotate(10deg);
            /* Rota la imagen 10 grados al hacer hover */
            transition: transform 0.3s ease;
            /* Agrega una transición suave */
        }

        .rounded {
            border-radius: 22px !important;
        }

        @keyframes slideInFromTop {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .box:hover {
            box-shadow: 0px 30px 40px -20px hsl(229, 31%, 21%);
        }

        @media (max-width: 450px) {
            .box {
                height: 200px;
            }
        }

        @media (max-width: 950px) and (min-width: 450px) {
            .box {
                text-align: center;
                height: 180px;
            }
        }

        @media (min-width: 950px) {
            .row1-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .row2-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .box-down {
                position: relative;
                top: 150px;
            }

            .box {
                width: 20%;

            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Para las imágenes */
        .img-cards {
            animation: fadeIn 1s ease-in-out;
        }

        /* Para los contenedores de texto */
        .h3-cards {
            animation: slideIn 1s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Contabilidad</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="container" id="content_list_options" style="display: block; cursor: pointer">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnCompras">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/compras.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Compras y
                                Gastos</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnVentas">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/ventas.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Ventas</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnNomina">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/nomina.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Nómina</a></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnContabilidad">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/contabilidad.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);"
                                style="color: white">Comprobantes</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnProductos">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/inventario.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Productos y
                                Servicios</a></h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnHabilitacion">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/habilitacion.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Habilitación
                                Electrónica</a></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnIndicadores">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/indicadores.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Indicadores</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnReportes">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/reportes.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Reportes</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 p-4 fadeIn box" id="btnReportesNomina">
                    <div class="col-12 rounded bg-info p-3 text-center">
                        <img src="{{ asset('assets/img/contabilidad/reportes_nomina.png') }}" width="100px" alt=""
                            class="img-cards">
                        <h3 class="mt-4 slideIn h3-cards"><a href="javascript:void(0);" style="color: white">Reportes de
                                Nómina</a></h3>
                    </div>
                </div>
            </div>
        </div>

        <div id="content_list_compras" style="display: none">
            <div class="card">
                <div class="card-header d-flex-header-table" style="border-radius: 4px">
                    <div class="div-1-tables-header">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-toggle="tab" data-target="#compras" type="button"
                                    role="tab" aria-controls="compras" aria-selected="true">Compras y
                                    Gastos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#nc_compras" type="button"
                                    role="tab" aria-controls="nc_compras" aria-selected="false">Notas
                                    Crédito</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#nd_compras" type="button"
                                    role="tab" aria-controls="nd_compras" aria-selected="false">Notas
                                    Débito</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#report_compras" type="button"
                                    role="tab" aria-controls="report_compras" aria-selected="false">Reportes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajust_compras" type="button"
                                    role="tab" aria-controls="ajust_compras" aria-selected="false">Ajustes</button>
                            </li>
                        </ul>
                    </div>
                    <div class="div-2-tables-header">
                        <button class="btn btn-primary btnBack">Regresar</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="compras" role="tabpanel"></div>
                        <div class="tab-pane fade" id="nc_compras" role="tabpanel"></div>
                        <div class="tab-pane fade" id="nd_compras" role="tabpanel"></div>
                        <div class="tab-pane fade" id="report_compras" role="tabpanel"></div>
                        <div class="tab-pane fade" id="ajust_compras" role="tabpanel"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content_list_ventas" style="display: none">
            <div class="card">
                <div class="card-header d-flex-header-table" style="border-radius: 4px">
                    <div class="div-1-tables-header">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-toggle="tab" data-target="#ventas" type="button"
                                    role="tab" aria-controls="ventas" aria-selected="true">Ventas</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#nc_ventas" type="button"
                                    role="tab" aria-controls="nc_ventas" aria-selected="false">Notas
                                    Crédito</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#nd_ventas" type="button"
                                    role="tab" aria-controls="nd_ventas" aria-selected="false">Notas
                                    Débito</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#report_ventas" type="button"
                                    role="tab" aria-controls="report_ventas" aria-selected="false">Reportes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajust_ventas" type="button"
                                    role="tab" aria-controls="ajust_ventas" aria-selected="false">Ajustes</button>
                            </li>
                        </ul>
                    </div>
                    <div class="div-2-tables-header">
                        <button class="btn btn-primary btnBack">Regresar</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="ventas" role="tabpanel"></div>
                        <div class="tab-pane fade" id="nc_ventas" role="tabpanel"></div>
                        <div class="tab-pane fade" id="nd_ventas" role="tabpanel"></div>
                        <div class="tab-pane fade" id="report_ventas" role="tabpanel"></div>
                        <div class="tab-pane fade" id="ajust_ventas" role="tabpanel"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content_list_nomina" style="display: none">
            <div class="card">
                <div class="card-header d-flex-header-table" style="border-radius: 4px">
                    <div class="div-1-tables-header">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-toggle="tab" data-target="#nomina" type="button"
                                    role="tab" aria-controls="nomina" aria-selected="true">Nómina</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#mas_nomina" type="button"
                                    role="tab" aria-controls="mas_nomina" aria-selected="false">Más Procesos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#report_nomina" type="button"
                                    role="tab" aria-controls="report_nomina" aria-selected="false">Reportes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajust_nomina" type="button"
                                    role="tab" aria-controls="ajust_nomina" aria-selected="false">Ajustes</button>
                            </li>
                        </ul>
                    </div>
                    <div class="div-2-tables-header">
                        <button class="btn btn-primary btnBack">Regresar</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="nomina" role="tabpanel"></div>
                        <div class="tab-pane fade" id="mas_nomina" role="tabpanel"></div>
                        <div class="tab-pane fade" id="report_nomina" role="tabpanel"></div>
                        <div class="tab-pane fade" id="ajust_nomina" role="tabpanel"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content_list_contabilidad" style="display: none">
            <div class="card">
                <div class="card-header d-flex-header-table" style="border-radius: 4px">
                    <div class="div-1-tables-header">
                        <ul class="nav nav-pills" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-toggle="tab" data-target="#contabilidad"
                                    type="button" role="tab" aria-controls="contabilidad"
                                    aria-selected="true">Movimientos Contables</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajustcartera_contabilidad"
                                    type="button" role="tab" aria-controls="ajustcartera_contabilidad"
                                    aria-selected="false">Ajustes de Cartera</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#mas_contabilidad"
                                    type="button" role="tab" aria-controls="mas_contabilidad"
                                    aria-selected="false">Más Procesos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#report_contabilidad"
                                    type="button" role="tab" aria-controls="report_contabilidad"
                                    aria-selected="false">Reportes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajust_contabilidad"
                                    type="button" role="tab" aria-controls="ajust_contabilidad"
                                    aria-selected="false">Ajustes</button>
                            </li>
                        </ul>
                    </div>
                    <div class="div-2-tables-header">
                        <button class="btn btn-primary btnBack">Regresar</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="contabilidad" role="tabpanel"></div>
                        <div class="tab-pane fade" id="ajustcartera_contabilidad" role="tabpanel"></div>
                        <div class="tab-pane fade" id="mas_contabilidad" role="tabpanel"></div>
                        <div class="tab-pane fade" id="report_contabilidad" role="tabpanel"></div>
                        <div class="tab-pane fade" id="ajust_contabilidad" role="tabpanel"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="content_list_reportes" style="display: none">
            <div class="card">
                <div class="card-header d-flex-header-table" style="border-radius: 4px">
                    <div class="div-1-tables-header">
                    </div>
                    <div class="div-2-tables-header">
                        <button class="btn btn-primary btnBack">Regresar</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="reportes_generales" role="tabpanel">
                            <!-- row -->
                            <div class="row row-sm">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card overflow-hidden project-card">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="my-auto">
                                                    <svg enable-background="new 0 0 469.682 469.682" version="1.1"
                                                        class="me-4 ht-60 wd-60 my-auto primary"
                                                        viewBox="0 0 469.68 469.68" xml:space="preserve"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m120.41 298.32h87.771c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449h-87.771c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449z" />
                                                        <path
                                                            d="m291.77 319.22h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                                        <path
                                                            d="m291.77 361.01h-171.36c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h171.36c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                                        <path
                                                            d="m420.29 387.14v-344.82c0-22.987-16.196-42.318-39.183-42.318h-224.65c-22.988 0-44.408 19.331-44.408 42.318v20.376h-18.286c-22.988 0-44.408 17.763-44.408 40.751v345.34c0.68 6.37 4.644 11.919 10.449 14.629 6.009 2.654 13.026 1.416 17.763-3.135l31.869-28.735 38.139 33.959c2.845 2.639 6.569 4.128 10.449 4.18 3.861-0.144 7.554-1.621 10.449-4.18l37.616-33.959 37.616 33.959c5.95 5.322 14.948 5.322 20.898 0l38.139-33.959 31.347 28.735c3.795 4.671 10.374 5.987 15.673 3.135 5.191-2.98 8.232-8.656 7.837-14.629v-74.188l6.269-4.702 31.869 28.735c2.947 2.811 6.901 4.318 10.971 4.18 1.806 0.163 3.62-0.2 5.224-1.045 5.493-2.735 8.793-8.511 8.361-14.629zm-83.591 50.155-24.555-24.033c-5.533-5.656-14.56-5.887-20.376-0.522l-38.139 33.959-37.094-33.959c-6.108-4.89-14.79-4.89-20.898 0l-37.616 33.959-38.139-33.959c-6.589-5.4-16.134-5.178-22.465 0.522l-27.167 24.033v-333.84c0-11.494 12.016-19.853 23.51-19.853h224.65c11.494 0 18.286 8.359 18.286 19.853v333.84zm62.693-61.649-26.122-24.033c-4.18-4.18-5.224-5.224-15.673-3.657v-244.51c1.157-21.321-15.19-39.542-36.51-40.699-0.89-0.048-1.782-0.066-2.673-0.052h-185.47v-20.376c0-11.494 12.016-21.42 23.51-21.42h224.65c11.494 0 18.286 9.927 18.286 21.42v333.32z" />
                                                        <path
                                                            d="m232.21 104.49h-57.47c-11.542 0-20.898 9.356-20.898 20.898v104.49c0 11.542 9.356 20.898 20.898 20.898h57.469c11.542 0 20.898-9.356 20.898-20.898v-104.49c1e-3 -11.542-9.356-20.898-20.897-20.898zm0 123.3h-57.47v-13.584h57.469v13.584zm0-34.482h-57.47v-67.918h57.469v67.918z" />
                                                    </svg>
                                                </div>
                                                <div class="project-content">
                                                    <h6>Invoices</h6>
                                                    <ul>
                                                        <li>
                                                            <strong>Processing</strong>
                                                            <span>5</span>
                                                        </li>

                                                        <li>
                                                            <strong>Paid</strong>
                                                            <span>56</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card  overflow-hidden project-card">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="my-auto">
                                                    <svg enable-background="new 0 0 438.891 438.891"
                                                        class="me-4 ht-60 wd-60 my-auto danger" version="1.1"
                                                        viewBox="0 0 438.89 438.89" xml:space="preserve"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m347.97 57.503h-39.706v-17.763c0-5.747-6.269-8.359-12.016-8.359h-30.824c-7.314-20.898-25.6-31.347-46.498-31.347-20.668-0.777-39.467 11.896-46.498 31.347h-30.302c-5.747 0-11.494 2.612-11.494 8.359v17.763h-39.707c-23.53 0.251-42.78 18.813-43.886 42.318v299.36c0 22.988 20.898 39.706 43.886 39.706h257.04c22.988 0 43.886-16.718 43.886-39.706v-299.36c-1.106-23.506-20.356-42.068-43.886-42.319zm-196.44-5.224h28.735c5.016-0.612 9.045-4.428 9.927-9.404 3.094-13.474 14.915-23.146 28.735-23.51 13.692 0.415 25.335 10.117 28.212 23.51 0.937 5.148 5.232 9.013 10.449 9.404h29.78v41.796h-135.84v-41.796zm219.43 346.91c0 11.494-11.494 18.808-22.988 18.808h-257.04c-11.494 0-22.988-7.314-22.988-18.808v-299.36c1.066-11.964 10.978-21.201 22.988-21.42h39.706v26.645c0.552 5.854 5.622 10.233 11.494 9.927h154.12c5.98 0.327 11.209-3.992 12.016-9.927v-26.646h39.706c12.009 0.22 21.922 9.456 22.988 21.42v299.36z" />
                                                        <path
                                                            d="m179.22 233.57c-3.919-4.131-10.425-4.364-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.363-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.211-0.391-0.412-0.601-0.604z" />
                                                        <path
                                                            d="m329.16 256.03h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                                        <path
                                                            d="m179.22 149.98c-3.919-4.131-10.425-4.364-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.364-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.211-0.391-0.412-0.601-0.604z" />
                                                        <path
                                                            d="m329.16 172.44h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                                        <path
                                                            d="m179.22 317.16c-3.919-4.131-10.425-4.363-14.629-0.522l-33.437 31.869-14.106-14.629c-3.919-4.131-10.425-4.363-14.629-0.522-4.047 4.24-4.047 10.911 0 15.151l21.42 21.943c1.854 2.076 4.532 3.224 7.314 3.135 2.756-0.039 5.385-1.166 7.314-3.135l40.751-38.661c4.04-3.706 4.31-9.986 0.603-14.025-0.19-0.21-0.391-0.411-0.601-0.604z" />
                                                        <path
                                                            d="m329.16 339.63h-120.16c-5.771 0-10.449 4.678-10.449 10.449s4.678 10.449 10.449 10.449h120.16c5.771 0 10.449-4.678 10.449-10.449s-4.678-10.449-10.449-10.449z" />
                                                    </svg>
                                                </div>
                                                <div class="project-content">
                                                    <h6>Tasks</h6>
                                                    <ul>
                                                        <li>
                                                            <strong>Processing</strong>
                                                            <span>42</span>
                                                        </li>

                                                        <li>
                                                            <strong>Completed</strong>
                                                            <span>23</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card overflow-hidden project-card">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="my-auto">
                                                    <svg enable-background="new 0 0 477.849 477.849"
                                                        class="me-4 ht-60 wd-60 my-auto success" version="1.1"
                                                        viewBox="0 0 477.85 477.85" xml:space="preserve"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m374.1 385.52c71.682-74.715 69.224-193.39-5.492-265.08-34.974-33.554-81.584-52.26-130.05-52.193-103.54-0.144-187.59 83.676-187.74 187.22-0.067 48.467 18.639 95.077 52.193 130.05l-48.777 65.024c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l47.275-63.044c65.4 47.651 154.08 47.651 219.48 0l47.275 63.044c5.655 7.541 16.353 9.069 23.893 3.413 7.541-5.655 9.069-16.353 3.413-23.893l-48.775-65.024zm-135.54 24.064c-84.792-0.094-153.51-68.808-153.6-153.6 0-84.831 68.769-153.6 153.6-153.6s153.6 68.769 153.6 153.6-68.769 153.6-153.6 153.6z" />
                                                        <path
                                                            d="m145.29 24.984c-33.742-32.902-87.767-32.221-120.67 1.521-32.314 33.139-32.318 85.997-8e-3 119.14 6.665 6.663 17.468 6.663 24.132 0l96.546-96.529c6.663-6.665 6.663-17.468 0-24.133zm-106.55 82.398c-12.186-25.516-1.38-56.08 24.136-68.267 13.955-6.665 30.175-6.665 44.131 0l-68.267 68.267z" />
                                                        <path
                                                            d="m452.49 24.984c-33.323-33.313-87.339-33.313-120.66 0-6.663 6.665-6.663 17.468 0 24.132l96.529 96.529c6.665 6.663 17.468 6.663 24.132 0 33.313-33.322 33.313-87.338 0-120.66zm-14.08 82.449-68.301-68.301c19.632-9.021 42.79-5.041 58.283 10.018 15.356 15.341 19.371 38.696 10.018 58.283z" />
                                                        <path
                                                            d="m238.56 136.52c-9.426 0-17.067 7.641-17.067 17.067v96.717l-47.787 63.71c-5.655 7.541-4.127 18.238 3.413 23.893s18.238 4.127 23.893-3.413l51.2-68.267c2.216-2.954 3.413-6.547 3.413-10.24v-102.4c1e-3 -9.426-7.64-17.067-17.065-17.067z" />
                                                    </svg>
                                                </div>
                                                <div class="project-content">
                                                    <h6>Estimates</h6>
                                                    <ul>
                                                        <li>
                                                            <strong>Processing</strong>
                                                            <span>2</span>
                                                        </li>

                                                        <li>
                                                            <strong>Accepted</strong>
                                                            <span>16</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card overflow-hidden project-card">
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="my-auto">
                                                    <svg enable-background="new 0 0 512 512"
                                                        class="me-4 ht-60 wd-60 my-auto warning" version="1.1"
                                                        viewBox="0 0 512 512" xml:space="preserve"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m259.2 317.72h-6.398c-8.174 0-14.824-6.65-14.824-14.824 1e-3 -8.172 6.65-14.822 14.824-14.822h6.398c8.174 0 14.825 6.65 14.825 14.824h29.776c0-20.548-13.972-37.885-32.911-43.035v-33.74h-29.777v33.739c-18.94 5.15-32.911 22.487-32.911 43.036 0 24.593 20.007 44.601 44.601 44.601h6.398c8.174 0 14.825 6.65 14.825 14.824s-6.65 14.824-14.825 14.824h-6.398c-8.174 0-14.824-6.65-14.824-14.824h-29.777c0 20.548 13.972 37.885 32.911 43.036v33.739h29.777v-33.74c18.94-5.15 32.911-22.487 32.911-43.035 0-24.594-20.008-44.603-44.601-44.603z" />
                                                        <path
                                                            d="m502.7 432.52c-7.232-60.067-26.092-111.6-57.66-157.56-27.316-39.764-65.182-76.476-115.59-112.06v-46.29l37.89-98.425-21.667-0.017c-6.068-4e-3 -8.259-1.601-13.059-5.101-6.255-4.559-14.821-10.802-30.576-10.814h-0.046c-15.726 0-24.292 6.222-30.546 10.767-4.799 3.487-6.994 5.081-13.041 5.081h-0.027c-6.07-5e-3 -8.261-1.602-13.063-5.101-6.255-4.559-14.821-10.801-30.577-10.814h-0.047c-15.725 0-24.293 6.222-30.548 10.766-4.8 3.487-6.995 5.081-13.044 5.081h-0.027l-21.484-0.017 36.932 98.721v46.117c-51.158 36.047-89.636 72.709-117.47 111.92-33.021 46.517-52.561 98.116-59.74 157.74l-9.304 77.285h512l-9.304-77.284zm-301.06-395.47c4.8-3.487 6.995-5.081 13.045-5.081h0.026c6.07 4e-3 8.261 1.602 13.062 5.101 6.255 4.559 14.821 10.802 30.578 10.814h0.047c15.725 0 24.292-6.222 30.546-10.767 4.799-3.487 6.993-5.081 13.041-5.081h0.026c6.068 5e-3 8.259 1.602 13.059 5.101 2.869 2.09 6.223 4.536 10.535 6.572l-21.349 55.455h-92.526l-20.762-55.5c4.376-2.041 7.773-4.508 10.672-6.614zm98.029 91.89v26.799h-83.375v-26.799h83.375zm-266.09 351.08 5.292-43.947c6.571-54.574 24.383-101.7 54.458-144.07 26.645-37.537 62.54-71.458 112.73-106.5h103.78c101.84 71.198 150.75 146.35 163.29 250.56l5.291 43.948h-444.85z" />
                                                    </svg>
                                                </div>
                                                <div class="project-content">
                                                    <h6>Revenue</h6>
                                                    <ul>
                                                        <li>
                                                            <strong>Earnings</strong>
                                                            <span>$15,425</span>
                                                        </li>
                                                        <li>
                                                            <strong>Expensive</strong>
                                                            <span>$8,147</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm ">
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                    <div class="card">
                                        <div class="card-header pt-4 pb-0">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="card-title mg-b-10 ">Task Statistics</h4>
                                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                                            </div>
                                            <p class="tx-12 text-muted mb-0">The Statistics You can also summarize your
                                                data in a graphical display, such as histograms <a href="">Learn
                                                    more</a> </p>
                                        </div>
                                        <div class="p-4">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-md-6 col-6 text-center">
                                                        <div class="task-box primary mb-0">
                                                            <p class="mb-0 tx-12">Total Tasks</p>
                                                            <h3 class="mb-0">385</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6 text-center">
                                                        <div class="task-box danger  mb-0">
                                                            <p class="mb-0 tx-12">Overdue Tasks</p>
                                                            <h3 class="mb-0">19</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="task-stat pb-0">
                                            <div class="d-flex tasks">
                                                <div class="mb-0">
                                                    <div class="h6 fs-15 mb-0"><i
                                                            class="far fa-dot-circle text-primary me-2"></i>Completed Tasks
                                                    </div>
                                                    <span class="text-muted tx-11 ms-4">8:00am - 10:30am</span>
                                                </div>
                                                <span class="float-end ms-auto">135</span>
                                            </div>
                                            <div class="d-flex tasks">
                                                <div class="mb-0">
                                                    <div class="h6 fs-15 mb-0"><i
                                                            class="far fa-dot-circle text-pink me-2"></i>Inprogress Tasks
                                                    </div>
                                                    <span class="text-muted tx-11 ms-4">8:00am - 10:30am</span>
                                                </div>
                                                <span class="float-end ms-auto">75</span>
                                            </div>
                                            <div class="d-flex tasks">
                                                <div class="mb-0">
                                                    <div class="h6 fs-15 mb-0"><i
                                                            class="far fa-dot-circle text-success me-2"></i>On Hold Tasks
                                                    </div>
                                                    <span class="text-muted tx-11 ms-4">8:00am - 10:30am</span>
                                                </div>
                                                <span class="float-end ms-auto">23</span>
                                            </div>
                                            <div class="d-flex tasks mb-0 border-bottom-0">
                                                <div class="mb-0">
                                                    <div class="h6 fs-15 mb-0"><i
                                                            class="far fa-dot-circle text-purple me-2"></i>Pending Tasks
                                                    </div>
                                                    <span class="text-muted tx-11 ms-4">8:00am - 10:30am</span>
                                                </div>
                                                <span class="float-end ms-auto">1</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
                                    <div class="card overflow-hidden">
                                        <div class="card-header pb-0">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="card-title mg-b-10 mt-2">Projects Workload</h4>
                                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                                            </div>
                                            <p class="tx-12 text-muted mb-0"> In the Project Workload report, their
                                                remaining assignments, completion dates, whether their work is at-risk. <a
                                                    href="">Learn more</a></p>
                                        </div>
                                        <div class="card-body">
                                            <div class="">
                                                <div class="row justify-content-md-center">
                                                    <div class="col-sm-12">
                                                        <div class="">
                                                            <canvas id="chartDonut" class="ht-175 drop-shadow"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-3">
                                                <div class="row ">
                                                    <div class="col-sm-8 ">
                                                        <h5 class="mb-0 tx-15 d-flex"><span
                                                                class="legend bg-primary-gradient brround"></span>40.32%
                                                            </h6>
                                                            <p class="text-muted  tx-13 mb-0">External</p>
                                                    </div>
                                                    <div class="col-sm-4 ">
                                                        <span id="sparkel1">1,3,7,8,4,5,4,8,6</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="pt-3">
                                                <div class="row ">
                                                    <div class="col-sm-8 ">
                                                        <h6 class="mb-0 tx-15 d-flex"><span
                                                                class="legend bg-danger-gradient brround"></span>40.73%
                                                        </h6>
                                                        <p class="text-muted tx-13 mb-0 ">Internal</p>
                                                    </div>
                                                    <div class="col-sm-4 ">
                                                        <span id="sparkel2">2,5,6,4,8,6,5,9,6</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-3">
                                                <div class="row ">
                                                    <div class="col-sm-8 ">
                                                        <h6 class="mb-0 tx-15 d-flex"><span
                                                                class="legend bg-success-gradient brround"></span>50.12%
                                                        </h6>
                                                        <p class="text-muted tx-13 mb-0">Other</p>
                                                    </div>
                                                    <div class="col-sm-4 ">
                                                        <span id="sparkel3">2,5,6,4,8,6,5,9,6</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="card overflow-hidden">
                                        <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                                            <div class="d-flex justify-content-between">
                                                <h4 class="card-title mg-b-10">Project Budget</h4>
                                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                                            </div>
                                            <p class="tx-12 text-muted mb-2">The Project Budget is a tool used by project
                                                managers to estimate the total cost of a project. <a href="">Learn
                                                    more</a></p>
                                        </div>
                                        <div class="card-body pd-y-7">
                                            <div class="area chart-legend mb-0">
                                                <div>
                                                    <i class="mdi mdi-album text-primary me-2"></i> Total Budget
                                                </div>
                                                <div>
                                                    <i class="mdi mdi-album text-pink me-2"></i>Amount Used
                                                </div>
                                            </div>
                                            <canvas id="project-budget" class="ht-300"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#btnCompras').click(function() {
                //$('#content_list_options').hide();
                //$('#content_list_compras').show();
                // redirigir a factura_compra
                window.location.href = "factura_compra";
            });

            $('#btnVentas').click(function() {
                //$('#content_list_options').hide();
                //$('#content_list_ventas').show();
                window.location.href = "factura_venta";
            });

            $('#btnNomina').click(function() {
                $('#content_list_options').hide();
                $('#content_list_nomina').show();
            });

            $('#btnContabilidad').click(function() {
                //$('#content_list_options').hide();
                //$('#content_list_contabilidad').show();
                window.location.href = "conciliacion_bancaria";
            });

            $("#btnReportes").click(function() {
                $('#content_list_options').hide();
                $('#content_list_reportes').show();
            });

            $('.btnBack').click(function() {
                $('#content_list_options').show();
                $('#content_list_compras').hide();
                $('#content_list_ventas').hide();
                $('#content_list_nomina').hide();
                $('#content_list_contabilidad').hide();
                $('#content_list_reportes').hide();
            });
        });
    </script>
@endsection
