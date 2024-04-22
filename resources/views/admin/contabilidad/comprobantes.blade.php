@extends('layouts.menu')

@section('css')
    <style>
        .bg-gray {
            background-color: #bfbfbf;
        }

        .pad-4 {
            padding: 4px !important;
            border: 0px !important;
        }

        .center-text {
            display: flex;
            border: 0 !important;
            justify-content: center;
        }

        .font-20 {
            font-size: 18px;
        }

        .font-22 {
            font-size: 20px;
            font-weight: 500;
        }

        #div_general {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        #div_form_add {
            -webkit-transition: 1s linear;
            transition: 1s linear;
            animation: 1s ease-in-out 0s 1 slideInFromTop
        }

        @keyframes slideInFromTop {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(0);
            }
        }

        .badge {
            margin-left: 6px;
            display: inline-block;
            padding: 0.25em 0.5em;
            /* Ajusta el padding según tus preferencias */
            font-size: 12px;
            /* Tamaño de fuente */
            font-weight: bold;
            /* Peso de la fuente */
            border-radius: 4px;
            /* Borde redondeado */
            background-color: #ffc107;
            /* Color de fondo */
            color: #000;
            /* Color del texto */
        }

        /* Estilo para el badge de éxito */
        .badge-success {
            background-color: #28a745;
            /* Color de fondo para el éxito */
            color: #fff;
            /* Color del texto para el éxito */
        }

        /* Estilo para el badge de advertencia */
        .badge-warning {
            background-color: #ffc107;
            /* Color de fondo para la advertencia */
            color: #000;
            /* Color del texto para la advertencia */
        }

        /* Estilo para el badge de error */
        .badge-danger {
            background-color: #dc3545;
            /* Color de fondo para el error */
            color: #fff;
            /* Color del texto para el error */
        }
    </style>

    <style>
        .btn-flotante {
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            border-radius: 5px;
            letter-spacing: 2px;
            background-color: #3858F9;
            padding: 18px 30px;
            position: fixed;
            bottom: 40px;
            right: 40px;
            transition: all 300ms ease 0ms;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }

        .btn-flotante:hover {
            background-color: #3858F9;
            color: #ffffff;
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-7px);
        }

        @media only screen and (max-width: 600px) {
            .btn-flotante {
                font-size: 14px;
                padding: 12px 20px;
                bottom: 20px;
                right: 20px;
            }
        }

        .bg-pending {
            background: rgb(255, 193, 7, .3);
        }

        .bg-paid {
            background: rgb(40, 167, 69, .3);
        }

        .bg-cancel {
            background: rgb(220, 53, 69, .3);
        }

        .center-div {
            display: flex;
            justify-content: center;
        }

        .pagination {
            margin-top: 14px;
            margin-bottom: 12px;
        }

        .page-link {
            color: #000;
            border-radius: 20px;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 20px;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            pointer-events: none;
            cursor: not-allowed;
            border-radius: 20px;
        }

        .orange {
            color: #FF8000;
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
                        <li class="breadcrumb-item active" aria-current="page"> Comprobantes Contables</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row row-sm" id="div_general">
            <div class="col-md-12 col-xl-4">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Comprobantes Contables <badge class="badge"
                                        style="background: #007bff; color: white;" id="cant_facturas">
                                        {{ count($comprobantes) }}
                                    </badge>
                                </h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                    data-bs-effect="effect-scale">+</button>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="main-invoice-list" id="mainInvoiceList">
                                @foreach ($comprobantes as $key => $comprobante)
                                    <div class="media view_btn" data-id="{{ $comprobante->id }}"
                                        data-archivos='{{ $comprobante->archivos }}'
                                        data-numero="{{ $comprobante->numero }}" data-tipo="{{ $comprobante->tipo }}"
                                        data-fecha="{{ date('d/m/Y', strtotime($comprobante->fecha)) }}">
                                        <div class="media-icon">
                                            <i class="far fa-file-alt"></i>
                                        </div>
                                        <div class="media-body">
                                            <h6><span>DOC-{{ $comprobante->numero }}</span>
                                                <span>{{ $comprobante->tipo }}</span>
                                            </h6>
                                            <div>
                                                <p><span>Fecha:</span>
                                                    {{ date('d/m/Y', strtotime($comprobante->fecha)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- main-invoice-list -->
            <div class="col-md-12 col-xl-8">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-body">
                            <div class="invoice-header">
                                <h1 class="invoice-title">COMPROBANTE CONTABLE</h1>
                                <div class="billed-from">
                                    <h6>RADIO ENLACE S.A.S.</h6>
                                    <p>Nit 830.504.313-5<br>
                                        Tel: (604) 4448280<br>
                                        Medellín - Colombia</p>
                                </div><!-- billed-from -->
                            </div><!-- invoice-header -->
                            <div id="content_factura" class="d-none">
                                <div class="row mg-t-20">
                                    <div class="col-md d-none">
                                        <label class="tx-gray-600">Facturado a</label>
                                        <div class="billed-to">
                                            <h6 id="cliente_view">EDATEL TIGO</h6>
                                            <p id="nit_view">Nit 890.905.065-2<br>
                                                Tel: (034) 3846500<br>
                                                Medellín - Colombia</p>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label class="tx-gray-600">Información del documento</label>
                                        <p class="invoice-info-row"><span>Documento No.</span> <span
                                                id="num_fact_view">1743</span>
                                        </p>
                                        <p class="invoice-info-row"><span>Tipo</span> <span id="num_2_fact_view">1743</span>
                                        </p>
                                        <p class="invoice-info-row"><span>Fecha</span> <span
                                                id="compra_view">21/03/2023</span></p>
                                    </div>
                                </div>
                                <div class="table-responsive mg-t-40">
                                    <table class="table table-invoice border text-md-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th class="wd-20p">Documento</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productos_view"></tbody>
                                    </table>
                                </div>
                                <hr>
                                <hr>
                                <div style="display: flex; justify-content: center;">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Otras Opciones
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item btn_options_factura btnEliminar"
                                                href="javascript:void(0)">Eliminar</a>
                                            <a class="dropdown-item btn_options_factura btnComprobante"
                                                href="javascript:void(0)">Crear comprobante</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="content_loader" class="d-none">
                                <div class="text-center">
                                    <div class="spinner-border" role="status" style="color: #3858f9">
                                        <span class="sr-only">Cargando...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>


        <!-- Modal Filtros -->
        <div class="modal  fade" id="modalSelectFilter">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Sección de filtros</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Tercero</label>
                                <select class="form-select" id="cliente_select">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }} -
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Fecha Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio_select">
                            </div>
                            <div class="col-lg">
                                <label for="">Fecha Fin</label>
                                <input type="date" class="form-control" id="fecha_fin_select">
                            </div>
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-primary btn-block" id="btn_filtrar">Filtrar</button>
                        <br>
                        <div class="text-center">
                            <a href="{{ route('comprobantes_contabilidad') }}" id="btn_clear">Limpiar filtros</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" class="btn-flotante" data-bs-target="#modalSelectFilter" data-bs-toggle="modal"
            data-bs-effect="effect-scale">Filtros</a>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
