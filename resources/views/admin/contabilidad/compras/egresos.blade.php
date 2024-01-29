@extends('layouts.menu')

@section('css')
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
                        <li class="breadcrumb-item active" aria-current="page"> Comprobantes de egreso</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <div id="content_list">
            <div class="row row-sm">
                <div class="col-md-12 col-xl-4">
                    <div class=" main-content-body-invoice">
                        <div class="card card-invoice">
                            <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                                <div class="div-1-tables-header">
                                    <h3 class="card-title">COMPROBANTES DE EGRESO</h3>
                                </div>
                                <div class="div-2-tables-header" style="margin-bottom: 13px">
                                    <button class="btn btn-primary" id="btnNew">+</button>
                                </div>
                            </div>
                            <div class="p-0">
                                <div class="main-invoice-list" id="mainInvoiceList">
                                    @foreach ($egresos as $key => $comprobante)
                                    @if ($comprobante->status == 0)
                                            @php
                                                $bg = 'bg-pending';
                                            @endphp
                                        @elseif($comprobante->status == 1)
                                            @php
                                                $bg = 'bg-paid';
                                            @endphp
                                        @else
                                            @php
                                                $bg = 'bg-cancel';
                                            @endphp
                                        @endif
                                        <div class="media comprobante_btn" @if($comprobante->grupo_facturas) data-grupo="1" @endif data-id="{{ $comprobante->id }}">
                                            <div class="media-icon">
                                                <i class="far fa-file-alt"></i>
                                            </div>
                                            <div class="media-body">

                                                <h6><span>Comprobante No.{{ $comprobante->numero }}</span>
                                                    <span>{{ $comprobante->valor }}</span>
                                                </h6>
                                                <div>
                                                    <p><span>Fecha:</span>
                                                        {{ date('d/m/Y', strtotime($comprobante->fecha_elaboracion)) }}</p>
                                                    <p>{{ $comprobante->proveedor }} (NIT:
                                                        {{ $comprobante->nit }}-{{ $comprobante->codigo_verificacion }})</p>
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
                                    <h1 class="invoice-title" id="title_factura"></h1>
                                    <div class="billed-from">
                                        <h6>RADIO ENLACE S.A.S.</h6>
                                        <p>Nit 830.504.313-5<br>
                                            Tel: (604) 4448280<br>
                                            Medellín - Colombia</p>
                                    </div><!-- billed-from -->
                                </div><!-- invoice-header -->
                                <div id="content_factura" class="d-none">
                                    <div class="row mg-t-20">
                                        <div class="col-md">
                                            <label class="tx-gray-600">Pagado a</label>
                                            <div class="billed-to">
                                                <h6 id="proveedor_view">EDATEL TIGO</h6>
                                                <p id="nit_view">Nit 890.905.065-2<br>
                                                    Tel: (034) 3846500<br>
                                                    Medellín - Colombia</p>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <label class="tx-gray-600">Información del comprobante</label>
                                            <p class="invoice-info-row"><span id="factura_tlt_2">Comprobante No.</span>
                                                <span id="num_fact_view">1743</span>
                                            </p>
                                            <p class="invoice-info-row"><span>Fecha Pago</span> <span
                                                    id="compra_view">21/03/2023</span></p>
                                            <p class="invoice-info-row"><span>Forma Pago</span> <span
                                                    id="vencimiento_view">20/04/2023</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="table-responsive mg-t-40">
                                        <table class="table table-invoice border text-md-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th colspan="5" class="text-center">Concepto</th>
                                                    <th style="text-align: right;">Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody id="productos_view"></tbody>
                                        </table>
                                    </div>
                                    <hr>
                                    <div style="display: flex; justify-content: center;">
                                        <a class="btn btn-success btn_imprimir_factura" style="margin-right: 10px;"
                                            target="_blank" href="{{ route('comprobante_egreso_pdf') }}?token=0">Descargar e
                                            Imprimir</a>

                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Otras Opciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <!--<a class="dropdown-item btn_options_factura" data-id="0" data-opcion="4"
                                                    href="javascript:void(0)">Ver Contabilización</a>
                                                <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="1"
                                                    href="javascript:void(0)">Duplicar</a>-->
                                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="0"
                                                    href="javascript:void(0)">Modificar</a>
                                                <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="1"
                                                    href="javascript:void(0)">Anular</a>
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
        </div>

        <!-- Modal Filtros -->
        <div class="modal  fade" id="modalSelect">
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
                                <label for="">Proveedor</label>
                                <select class="form-select" id="proveedor_select">
                                    <option value="">Seleccione una opción</option>|
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }} -
                                            ({{ $proveedor->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--<br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Número Factura</label>
                                <input type="number" placeholder="Número Factura" class="form-control"
                                    id="factura_select">
                            </div>
                            <div class="col-lg">
                                <label for="">Serial (Producto)</label>
                                <input type="number" placeholder="Serial (Producto)" class="form-control"
                                    id="serial_factura_select">
                            </div>
                        </div>-->
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Fecha Inicio</label>
                                <input type="date" class="form-control" id="inicio_select">
                            </div>
                            <div class="col-lg">
                                <label for="">Fecha Fin</label>
                                <input type="date" class="form-control" id="fin_select">
                            </div>
                        </div>
                        <br>
                        <br>
                        <button class="btn btn-primary btn-block" id="btn_filtrar">Filtrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add -->
        <div class="modal  fade" id="modalCliente">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Selecciona un proveedor</h6>
                        <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Proveedor</label>
                                <select class="form-select" id="cliente_select_add">
                                    <option value="">Seleccione una opción</option>|
                                    @foreach ($proveedores as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }} -
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-primary btn-block" id="btn_select_add">Seleccionar cliente</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add -->
        <div id="content_add" class="d-none">
            <div class="row row-sm">
                <div class="col-md-12 col-xl-12">
                    <div class=" main-content-body-invoice">
                        <div class="card card-invoice">
                            <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                                <div class="div-1-tables-header">
                                    <h3 class="card-title">Nuevo egreso</h3>
                                </div>
                                <div class="div-2-tables-header" style="margin-bottom: 13px">
                                    <a href="{{ route('comprobantes_egresos') }}" class="btn btn-primary back_home">x</a>
                                </div>
                            </div>
                            <div class="p-0">
                                <div class="card-body" style="margin-top: -18px;">
                                    <div class="row row-sm">
                                        <div class="col-lg-4">
                                            <label for="">Tipo</label>
                                            <select class="form-select" id="tipo_add">
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">(CE-1) Comprobante Egreso</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Fecha de pago</label>
                                            <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_add"
                                                placeholder="Fecha de pago" type="date">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="">Número</label>
                                            <input class="form-control text-center" value="{{ $num_egreso }}" disabled
                                                id="numero_add" placeholder="Número" type="text">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="">Número Siigo</label>
                                            <input class="form-control text-center" id="numero_siigo_add"
                                                placeholder="Número Siigo" type="number">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row row-sm">
                                        <div class="col-lg-4">
                                            <label for="">Proveedor / otros</label>
                                            <select class="form-select" id="cliente_add" disabled>
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($proveedores as $cliente)
                                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                        ({{ $cliente->nit }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="">Realizar un</label>
                                            <select class="form-select" id="transaccion_add" disabled>
                                                <option value="1">Abono a deuda</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="">Dónde ingresa el dinero</label>
                                            <select class="form-select" id="formas_pago_add">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($formas_pago as $forma_pago)
                                                    <option value="{{ $forma_pago->id }}">{{ $forma_pago->code }} |
                                                        {{ $forma_pago->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row row-sm" style="display: flex; justify-content: end">
                                        <div class="col-lg-3">
                                            <label for="">Valor Pagado</label>
                                            <input class="form-control input_dinner" style="text-align: right;"
                                                value="0.00" id="valor_add" placeholder="Número" type="text">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="table-responsive">
                                            <table id="tbl_data_detail"
                                                class="table border-top-0 table-bordered text-nowrap border-bottom">
                                                <thead>
                                                    <tr class="bg-gray">
                                                        <th class="text-center"><!--<input type="checkbox" checked
                                                                    id="check_all">-->
                                                        </th>
                                                        <th class="text-center">Factura</th>
                                                        <th class="text-center">Retenciones</th>
                                                        <th class="text-center">Valor Factura</th>
                                                        <th class="text-center">Saldo Total</th>
                                                        <th class="text-center">Saldo a Pagar</th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_facturas_list"></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-end"></th>
                                                        <th class="text-center" id="valor_facturas">0.00</th>
                                                        <th class="text-center" id="total_saldo">0.00</th>
                                                        <th class="text-center" id="total_saldo_pendiente">0.00</th>
                                                        <th class="text-end" id="saldo_pagado">0.00</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <label for="">Observaciones</label>
                                            <textarea class="form-control" id="observaciones_add" placeholder="Observaciones" rows="3"
                                                style="resize: none"></textarea>
                                        </div>

                                        <div class="col-lg mt-4">
                                            <label for="">Adjunto</label>
                                            <input class="form-control" accept="application/pdf" id="factura_add"
                                                placeholder="Contacto" type="file">
                                        </div>
                                    </div>
                                    <div class="text-center mt-5">
                                        <button class="btn btn-success" id="btnAddPago">Guardar Pago</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit -->
        <div id="content_edit" class="d-none">
            <div class="row row-sm">
                <div class="col-md-12 col-xl-12">
                    <div class=" main-content-body-invoice">
                        <div class="card card-invoice">
                            <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                                <div class="div-1-tables-header">
                                    <h3 class="card-title">Modificar egreso</h3>
                                </div>
                                <div class="div-2-tables-header" style="margin-bottom: 13px">
                                    <a href="{{ route('comprobantes_egresos') }}" class="btn btn-primary back_home">x</a>
                                </div>
                            </div>
                            <div class="p-0">
                                <div class="card-body" style="margin-top: -18px;">
                                    <input type="hidden" id="id_edit_pago" disabled>
                                    <div class="row row-sm">
                                        <div class="col-lg-4">
                                            <label for="">Tipo</label>
                                            <select class="form-select" id="tipo_edit">
                                                <option value="">Seleccione una opción</option>
                                                <option value="1">(CE-1) Comprobante Egreso</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="">Fecha de pago</label>
                                            <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_edit"
                                                placeholder="Fecha de pago" type="date">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="">Número</label>
                                            <input class="form-control text-center" value="{{ $num_egreso }}" disabled
                                                id="numero_edit" placeholder="Número" type="text">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="">Número Siigo</label>
                                            <input class="form-control text-center" id="numero_siigo_edit"
                                                placeholder="Número Siigo" type="number">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row row-sm">
                                        <div class="col-lg-4">
                                            <label for="">Proveedor / otros</label>
                                            <select class="form-select" id="cliente_edit" disabled>
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($proveedores as $cliente)
                                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                        ({{ $cliente->nit }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="">Realizar un</label>
                                            <select class="form-select" id="transaccion_edit" disabled>
                                                <option value="1">Abono a deuda</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="">Dónde ingresa el dinero</label>
                                            <select class="form-select" id="formas_pago_edit">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($formas_pago as $forma_pago)
                                                    <option value="{{ $forma_pago->id }}">{{ $forma_pago->code }} |
                                                        {{ $forma_pago->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row row-sm" style="display: flex; justify-content: end">
                                        <div class="col-lg-3">
                                            <label for="">Valor Pagado</label>
                                            <input class="form-control input_dinner" style="text-align: right;"
                                                value="0.00" id="valor_edit" placeholder="Número" type="text">
                                        </div>
                                    </div>
                                    <div class="row row-sm mt-3">
                                        <div class="table-responsive">
                                            <table id="tbl_data_detail"
                                                class="table border-top-0 table-bordered text-nowrap border-bottom">
                                                <thead>
                                                    <tr class="bg-gray">
                                                        <th class="text-center"><!--<input type="checkbox" checked
                                                                    id="check_all">-->
                                                        </th>
                                                        <th class="text-center">Factura</th>
                                                        <th class="text-center">Retenciones</th>
                                                        <th class="text-center">Valor Factura</th>
                                                        <th class="text-center">Saldo Total</th>
                                                        <th class="text-center">Saldo a Pagar</th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_facturas_list_edit"></tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3" class="text-end"></th>
                                                        <th class="text-center" id="valor_facturas_edit">0.00</th>
                                                        <th class="text-center" id="total_saldo_edit">0.00</th>
                                                        <th class="text-center" id="total_saldo_pendiente_edit">0.00</th>
                                                        <th class="text-end" id="saldo_pagado_edit">0.00</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row row-sm">
                                        <div class="col-lg">
                                            <label for="">Observaciones</label>
                                            <textarea class="form-control" id="observaciones_edit" placeholder="Observaciones" rows="3"
                                                style="resize: none"></textarea>
                                        </div>

                                        <div class="col-lg mt-4">
                                            <label for="">Adjunto</label>
                                            <input class="form-control" accept="application/pdf" id="factura_edit"
                                                placeholder="Contacto" type="file">
                                        </div>
                                    </div>
                                    <div class="text-center mt-5">
                                        <button class="btn btn-success" id="btnEditPago">Guardar Pago</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" class="btn-flotante" data-bs-target="#modalSelect" data-bs-toggle="modal"
            data-bs-effect="effect-scale">Filtros</a>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let rete_fuentes = @json($rete_fuentes);
            let rete_iva = @json($rete_iva);
            let rete_ica = @json($rete_ica);


            localStorage.setItem('rete_fuentes', JSON.stringify(rete_fuentes));
            localStorage.setItem('rete_iva', JSON.stringify(rete_iva));
            localStorage.setItem('rete_ica', JSON.stringify(rete_ica));
        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/compras/egresos.js') }}"></script>
@endsection
