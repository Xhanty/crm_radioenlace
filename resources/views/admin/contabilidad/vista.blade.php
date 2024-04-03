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
                                style="color: white">Contabilidad</a></h3>
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
                                <button class="nav-link active" data-toggle="tab" data-target="#compras"
                                    type="button" role="tab" aria-controls="compras" aria-selected="true">Compras y
                                    Gastos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#nc_compras"
                                    type="button" role="tab" aria-controls="nc_compras" aria-selected="false">Notas
                                    Crédito</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#nd_compras"
                                    type="button" role="tab" aria-controls="nd_compras" aria-selected="false">Notas
                                    Débito</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#report_compras"
                                    type="button" role="tab" aria-controls="report_compras"
                                    aria-selected="false">Reportes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajust_compras"
                                    type="button" role="tab" aria-controls="ajust_compras"
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
                                <button class="nav-link active" data-toggle="tab" data-target="#ventas"
                                    type="button" role="tab" aria-controls="ventas" aria-selected="true">Ventas</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#nc_ventas"
                                    type="button" role="tab" aria-controls="nc_ventas" aria-selected="false">Notas
                                    Crédito</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#nd_ventas"
                                    type="button" role="tab" aria-controls="nd_ventas" aria-selected="false">Notas
                                    Débito</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#report_ventas"
                                    type="button" role="tab" aria-controls="report_ventas"
                                    aria-selected="false">Reportes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajust_ventas"
                                    type="button" role="tab" aria-controls="ajust_ventas"
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
                                <button class="nav-link active" data-toggle="tab" data-target="#nomina"
                                    type="button" role="tab" aria-controls="nomina" aria-selected="true">Nómina</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#mas_nomina"
                                    type="button" role="tab" aria-controls="mas_nomina" aria-selected="false">Más Procesos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#report_nomina"
                                    type="button" role="tab" aria-controls="report_nomina"
                                    aria-selected="false">Reportes</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajust_nomina"
                                    type="button" role="tab" aria-controls="ajust_nomina"
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
                                    type="button" role="tab" aria-controls="contabilidad" aria-selected="true">Movimientos Contables</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-toggle="tab" data-target="#ajustcartera_contabilidad"
                                    type="button" role="tab" aria-controls="ajustcartera_contabilidad" aria-selected="false">Ajustes de Cartera</button>
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
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#btnCompras').click(function() {
                $('#content_list_options').hide();
                $('#content_list_compras').show();
            });

            $('#btnVentas').click(function() {
                $('#content_list_options').hide();
                $('#content_list_ventas').show();
            });

            $('#btnNomina').click(function() {
                $('#content_list_options').hide();
                $('#content_list_nomina').show();
            });

            $('#btnContabilidad').click(function() {
                $('#content_list_options').hide();
                $('#content_list_contabilidad').show();
            });

            $('.btnBack').click(function() {
                $('#content_list_options').show();
                $('#content_list_compras').hide();
                $('#content_list_ventas').hide();
                $('#content_list_nomina').hide();
                $('#content_list_contabilidad').hide();
            });
        });
    </script>
@endsection
