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
                        <li class="breadcrumb-item active" aria-current="page"> Facturas de compra</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->
        <div class="row row-sm" id="div_general">
            <div class="col-md-12 col-xl-4">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">FACTURAS DE COMPRA</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button class="btn btn-primary" id="btnNew">+</button>
                                <button class="btn btn-primary" style="margin-right: 10px;" id="btnSiigo">:)</button>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="main-invoice-list" id="mainInvoiceList">
                                @foreach ($facturas as $key => $factura)
                                    @if ($factura->status == 0)
                                        @php
                                            $bg = 'bg-cancel';
                                        @endphp
                                    @elseif($factura->status == 2)
                                        @php
                                            $bg = 'bg-paid';
                                        @endphp
                                    @else
                                        @php
                                            $bg = 'bg-pending';
                                        @endphp
                                    @endif

                                    <div class="media factura_btn {{ $bg }}" data-id="{{ $factura->id }}">
                                        <div class="media-icon">
                                            <i class="far fa-file-alt"></i>
                                        </div>
                                        <div class="media-body">
                                            @php
                                                $tipo = 'Factura No.';
                                                if ($factura->tipo == 1) {
                                                    $tipo = 'Factura No.';
                                                } else {
                                                    $tipo = 'Documento No.';
                                                }
                                            @endphp

                                            <h6><span>{{ $tipo }}{{ $factura->numero }}</span>
                                                <span>{{ $factura->valor_total }}
                                                    @if ($factura->favorito == 0)
                                                        <i data-id="{{ $factura->id }}"
                                                            class="far fa-star btn_favorite"></i>
                                                </span>
                                            @else
                                                <i data-id="{{ $factura->id }}"
                                                    class="fas fa-star btn_favorite orange"></i></span>
                                @endif
                                </h6>
                                <div>
                                    <p><span>Fecha:</span>
                                        {{ date('d/m/Y', strtotime($factura->fecha_elaboracion)) }}</p>
                                    <p>{{ $factura->razon_social }} (NIT:
                                        {{ $factura->nit }}-{{ $factura->codigo_verificacion }})</p>
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
                                <label class="tx-gray-600">Facturado a</label>
                                <div class="billed-to">
                                    <h6 id="proveedor_view">EDATEL TIGO</h6>
                                    <p id="nit_view">Nit 890.905.065-2<br>
                                        Tel: (034) 3846500<br>
                                        Medellín - Colombia</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">Información de la factura</label>
                                <p class="invoice-info-row"><span id="factura_tlt_2">Factura No.</span> <span
                                        id="num_fact_view">1743</span>
                                </p>
                                <p class="invoice-info-row"><span>Fecha Compra</span> <span
                                        id="compra_view">21/03/2023</span></p>
                                <p class="invoice-info-row"><span>Fecha Vencimiento</span> <span
                                        id="vencimiento_view">20/04/2023</span>
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">Ítem</th>
                                        <th class="wd-40p">Descripción</th>
                                        <th class="tx-center">Cantidad</th>
                                        <th class="tx-center">Impuesto<br>Cargo</th>
                                        <th class="tx-center">Impuesto<br>Rete.</th>
                                        <th class="tx-right">Valor Total</th>
                                    </tr>
                                </thead>
                                <tbody id="productos_view"></tbody>
                            </table>
                        </div>
                        <hr>
                        <div style="display: flex; justify-content: center;">
                            <a class="btn btn-success btn_pago_factura" data-id="0" style="margin-right: 10px;"
                                href="javascript:void(0);">Recibir Pago</a>

                            <a class="btn btn-primary btn_imprimir_factura" style="margin-right: 10px;" target="_blank"
                                href="{{ route('pdf_factura_compra') }}?token=0">Descargar e
                                Imprimir</a>

                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Otras Opciones
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="4"
                                        href="javascript:void(0)">Ver Contabilización</a>
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="3"
                                        href="javascript:void(0)">Aplicar Nota Débito</a>
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="2"
                                        href="javascript:void(0)">Anular</a>
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="1"
                                        href="javascript:void(0)">Duplicar</a>
                                    <a class="dropdown-item btn_options_factura" data-id="0" data-opcion="0"
                                        href="javascript:void(0)">Modificar</a>
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

    <!-- Add -->
    <div class="row row-sm d-none" id="div_form_add">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title">Nueva factura de compra</h3>
                        </div>
                        <div class="div-2-tables-header" style="margin-bottom: 13px">
                            <button class="btn btn-primary back_home">x</button>
                        </div>
                    </div>
                    <div class="p-0">
                        <div class="card-body" style="margin-top: -18px;">
                            <div class="row row-sm">
                                <div class="col-lg-3">
                                    <label for="">Tipo</label>
                                    <select class="form-select" id="tipo_add">
                                        <option value="">Seleccione una opción</option>
                                        <option value="1">(FC-1) Factura Electrónica Compra</option>
                                        <option value="2">(FC-2) Documento Soporte</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Centro de costo</label>
                                    <select class="form-select" id="centro_costo_add">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($centros_costos as $centro_costo)
                                            <option value="{{ $centro_costo->id }}">({{ $centro_costo->code }})
                                                {{ $centro_costo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Fecha elaboración</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_add"
                                        placeholder="Fecha elaboración" type="date">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Número</label>
                                    <input class="form-control text-center" value="{{ $num_factura }}" disabled
                                        id="numero_add" placeholder="Número" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg-3">
                                    <label for="">Proveedor</label>
                                    <select class="form-select" id="proveedor_add">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}
                                                ({{ $proveedor->nit }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <label for="">Contacto</label>
                                    <input class="form-control" disabled id="contacto_add" placeholder="Contacto"
                                        type="text">
                                </div>

                                <div class="col-lg-3">
                                    <label for="">No. Factura Proveedor</label>
                                    <input class="form-control text-center" value="FC" id="factura1_proveedor_add"
                                        placeholder="No. Factura Proveedor" type="text">
                                </div>

                                <div class="col-lg-3">
                                    <label for="">Consecutivo Factura Proveedor</label>
                                    <input class="form-control text-center" id="factura2_proveedor_add"
                                        placeholder="Consecutivo Factura Proveedor" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg">
                                </div>
                                <div class="col-lg">
                                    <label class="ckbox"><input id="chk_proveedor" type="checkbox"><span>Proveedor
                                            por item</span></label>
                                </div>

                                <div class="col-lg">
                                    <label class="ckbox"><input id="chk_iva" type="checkbox"><span>IVA/Impoconsumo
                                            incluido</span></label>
                                </div>

                                <div class="col-lg">
                                    <label class="ckbox"><input id="chk_procentaje" type="checkbox"><span>Descuento
                                            en porcentaje</span></label>
                                </div>
                                <div class="col-lg">
                                </div>
                            </div>
                            <div class="row row-sm mt-5">
                                <div class="table-responsive">
                                    <table id="tbl_data_detail"
                                        class="table border-top-0 table-bordered text-nowrap border-bottom">
                                        <thead>
                                            <tr class="bg-gray">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Tipo</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Descripción</th>
                                                <th class="text-center">Bodega</th>
                                                <th class="text-center">Cant</th>
                                                <th class="text-center">Valor Unitario</th>
                                                <th class="text-center">Descuento</th>
                                                <th class="text-center">Impuesto<br>Cargo</th>
                                                <th class="text-center">Impuesto<br>Retención</th>
                                                <th class="text-center">Valor Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background: #f9f9f9;">
                                                <td class="center-text pad-4">1</td>
                                                <td class="pad-4">
                                                    <select class="form-select tipo_add">
                                                        <option value="">Seleccione una opción</option>
                                                        <option value="1">Producto</option>
                                                        <option value="2">Activo Fijo</option>
                                                        <option value="3">Gasto / Cuenta contable</option>
                                                    </select>
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select producto_add">
                                                        <option value="">Seleccione una opción</option>
                                                    </select>
                                                    <input type="text" class="form-control mt-2 serial_producto_add"
                                                        disabled placeholder="Serial">
                                                </td>
                                                <td class="pad-4">
                                                    <textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="3"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Bodega" disabled
                                                        class="form-control bodega_add" style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="number" placeholder="Cantidad" step="1"
                                                        min="1" class="form-control text-end cantidad_add"
                                                        value="1" style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Valor Unitario" value="0.00"
                                                        class="form-control text-end valor_add input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" min="0" max="100"
                                                        placeholder="Descuento" value="0.00"
                                                        class="form-control text-end descuento_add input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select cargo_add">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_cargos as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}" value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select retencion_add">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_retencion as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}" value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-center d-flex pad-4">
                                                    <input disabled type="text" placeholder="0.00"
                                                        class="form-control text-end total_add input_dinner"
                                                        style="border: 0">
                                                    <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                        id="new_row"><i class="fa fa-plus"></i></a>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row row-sm mt-3">
                                <div class="col-lg-6 mt-3">
                                    <h3 class="card-title">Forma de pago</h3>
                                    <hr>
                                    <div class="row row-sm">
                                        <div class="col-lg-6">
                                            <select class="form-select formas_pago_add">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($formas_pago as $forma_pago)
                                                    <option value="{{ $forma_pago->id }}">{{ $forma_pago->code }} |
                                                        {{ $forma_pago->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-3 d-flex" style="justify-content: end">
                                            <input type="text" placeholder="0.00"
                                                class="form-control col-8 text-end input_dinner forma_pago_input_add">
                                        </div>
                                        <div class="col-lg-1 d-flex" style="justify-content: center">
                                            <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                id="new_row_forma"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div id="list_formas_pago"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row row-sm mt-2">
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Total Bruto:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_bruto_add">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Descuentos:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_descuentos_add">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Subtotal:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_subtotal_add">0.00</p>
                                            </div>
                                        </div>
                                        <div id="impuestos_1_add" style="padding: 0px;"></div>
                                        <div id="impuestos_2_add" style="padding: 0px;"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="padding-right: 15px">
                                <div class="col-lg d-flex" style="justify-content: end">
                                    <div>
                                        <p class="font-22">Total formas de pagos:</p>
                                    </div>
                                    <div style="margin-left: 10%">
                                        <p class="font-22" id="total_formas_pago_add">0.00</p>
                                    </div>
                                </div>

                                <div class="col-lg d-flex" style="justify-content: end">
                                    <div>
                                        <p class="font-22">Total Neto:</p>
                                    </div>
                                    <div style="margin-left: 10%">
                                        <p class="font-22" id="total_neto_add">0.00</p>
                                    </div>
                                </div>
                            </div>
                            <br>
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
                                <button class="btn btn-primary" id="btnAddFactura">Guardar Factura</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="row row-sm d-none" id="div_form_edit">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                        <div class="div-1-tables-header">
                            <h3 class="card-title">Modificar factura de compra</h3>
                        </div>
                        <div class="div-2-tables-header" style="margin-bottom: 13px">
                            <button class="btn btn-primary back_home">x</button>
                        </div>
                    </div>
                    <div class="p-0">
                        <div class="card-body" style="margin-top: -18px;">
                            <input type="hidden" disabled readonly id="id_factura_edit">
                            <div class="row row-sm">
                                <div class="col-lg-3">
                                    <label for="">Tipo</label>
                                    <select class="form-select" id="tipo_edit">
                                        <option value="">Seleccione una opción</option>
                                        <option value="1">(FC-1) Factura Electrónica Compra</option>
                                        <option value="2">(FC-2) Documento Soporte</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Centro de costo</label>
                                    <select class="form-select" id="centro_costo_edit">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($centros_costos as $centro_costo)
                                            <option value="{{ $centro_costo->id }}">({{ $centro_costo->code }})
                                                {{ $centro_costo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Fecha elaboración</label>
                                    <input class="form-control" id="fecha_edit" placeholder="Fecha elaboración"
                                        type="date">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Número</label>
                                    <input class="form-control text-center" disabled id="numero_edit"
                                        placeholder="Número" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg-3">
                                    <label for="">Proveedor</label>
                                    <select class="form-select" id="proveedor_edit">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}
                                                ({{ $proveedor->nit }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <label for="">Contacto</label>
                                    <input class="form-control" disabled id="contacto_edit" placeholder="Contacto"
                                        type="text">
                                </div>

                                <div class="col-lg-3">
                                    <label for="">No. Factura Proveedor</label>
                                    <input class="form-control text-center" value="FC" id="factura1_proveedor_edit"
                                        placeholder="No. Factura Proveedor" type="text">
                                </div>

                                <div class="col-lg-3">
                                    <label for="">Consecutivo Factura Proveedor</label>
                                    <input class="form-control text-center" id="factura2_proveedor_edit"
                                        placeholder="Consecutivo Factura Proveedor" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg">
                                </div>
                                <div class="col-lg">
                                    <label class="ckbox"><input id="chk_proveedor_edit" type="checkbox"><span>Proveedor
                                            por item</span></label>
                                </div>

                                <div class="col-lg">
                                    <label class="ckbox"><input id="chk_iva_edit" type="checkbox"><span>IVA/Impoconsumo
                                            incluido</span></label>
                                </div>

                                <div class="col-lg">
                                    <label class="ckbox"><input id="chk_procentaje_edit" type="checkbox"><span>Descuento
                                            en porcentaje</span></label>
                                </div>
                                <div class="col-lg">
                                </div>
                            </div>
                            <div class="row row-sm mt-5">
                                <div class="table-responsive">
                                    <table id="tbl_data_detail_edit"
                                        class="table border-top-0 table-bordered text-nowrap border-bottom">
                                        <thead>
                                            <tr class="bg-gray">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Tipo</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Descripción</th>
                                                <th class="text-center">Bodega</th>
                                                <th class="text-center">Cant</th>
                                                <th class="text-center">Valor Unitario</th>
                                                <th class="text-center">Descuento</th>
                                                <th class="text-center">Impuesto<br>Cargo</th>
                                                <th class="text-center">Impuesto<br>Retención</th>
                                                <th class="text-center">Valor Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background: #f9f9f9;">
                                                <td class="center-text pad-4">1</td>
                                                <td class="pad-4">
                                                    <select class="form-select tipo_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        <option value="1">Producto</option>
                                                        <option value="2">Activo Fijo</option>
                                                        <option value="3">Gasto / Cuenta contable</option>
                                                    </select>
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select producto_edit">
                                                        <option value="">Seleccione una opción</option>
                                                    </select>
                                                    <input type="text" class="form-control mt-2 serial_producto_edit"
                                                        disabled placeholder="Serial">
                                                </td>
                                                <td class="pad-4">
                                                    <textarea placeholder="Descripción" class="form-control descripcion_edit" style="border: 0" rows="3"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Bodega"
                                                        class="form-control bodega_edit" style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="number" placeholder="Cantidad" step="1"
                                                        min="1" class="form-control text-end cantidad_edit"
                                                        value="1" style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Valor Unitario" value="0.00"
                                                        class="form-control text-end valor_edit input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" min="0" max="100"
                                                        placeholder="Descuento" value="0.00"
                                                        class="form-control text-end descuento_edit input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select cargo_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_cargos as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select retencion_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_retencion as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}" value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="text-center d-flex pad-4">
                                                    <input disabled type="text" placeholder="0.00"
                                                        class="form-control text-end total_edit input_dinner"
                                                        style="border: 0">
                                                    <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                        id="new_row_edit"><i class="fa fa-plus"></i></a>
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <div class="row row-sm mt-3">
                                <div class="col-lg-6 mt-3">
                                    <h3 class="card-title">Forma de pago</h3>
                                    <hr>
                                    <div class="row row-sm">
                                        <div class="col-lg-6">
                                            <select class="form-select formas_pago_edit">
                                                <option value="">Seleccione una opción</option>
                                                @foreach ($formas_pago as $forma_pago)
                                                    <option value="{{ $forma_pago->id }}">{{ $forma_pago->code }} |
                                                        {{ $forma_pago->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-3 d-flex" style="justify-content: end">
                                            <input type="text" placeholder="0.00"
                                                class="form-control col-8 text-end input_dinner forma_pago_input_edit">
                                        </div>
                                        <div class="col-lg-1 d-flex" style="justify-content: center">
                                            <a class="center-vertical mg-s-10" href="javascript:void(0)"
                                                id="new_row_forma_edit"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                    <div id="list_formas_pago_edit"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row row-sm mt-2">
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Total Bruto:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_bruto_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Descuentos:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_descuentos_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-6">
                                                <p class="font-20">Subtotal:</p>
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_subtotal_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div id="impuestos_1_edit" style="padding: 0px;"></div>
                                        <div id="impuestos_2_edit" style="padding: 0px;"></div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row" style="padding-right: 15px">
                                <div class="col-lg d-flex" style="justify-content: end">
                                    <div>
                                        <p class="font-22">Total formas de pagos:</p>
                                    </div>
                                    <div style="margin-left: 10%">
                                        <p class="font-22" id="total_formas_pago_edit">0.00</p>
                                    </div>
                                </div>

                                <div class="col-lg d-flex" style="justify-content: end">
                                    <div>
                                        <p class="font-22">Total Neto:</p>
                                    </div>
                                    <div style="margin-left: 10%">
                                        <p class="font-22" id="total_neto_edit">0.00</p>
                                    </div>
                                </div>
                            </div>
                            <br>
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
                                <button class="btn btn-primary" id="btnEditFactura">Modificar Factura</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Número Factura</label>
                            <input type="number" placeholder="Número Factura" class="form-control" id="factura_select">
                        </div>
                        <div class="col-lg">
                            <label for="">Serial (Producto)</label>
                            <input type="number" placeholder="Serial (Producto)" class="form-control"
                                id="serial_factura_select">
                        </div>
                    </div>
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

    <!-- Modal Bodega Add -->
    <div class="modal  fade" id="bodegaAddModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Bodega</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- col -->
                        <div class="col-lg mt-4 mt-lg-0">
                            <label for="">Almacén de llegada</label>
                            <ul id="tree1"
                                style="padding: 20px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; border-radius: 10px;">
                                @foreach ($almacenes as $key => $almacen)
                                    <li><a href="javascript:void(0);">{{ $almacen->nombre }}</a>
                                        @if (count($almacen->almacenes) > 0)
                                            <ul>
                                                @foreach ($almacen->almacenes as $sub2)
                                                    <li style="cursor: pointer">{{ $sub2->nombre }}
                                                        &nbsp;
                                                        <a href="javascript:void(0);" class="btn_AlmacenAdd"
                                                            data-id="{{ $sub2->id }}"
                                                            data-name="{{ $sub2->nombre }}" title="Seleccionar">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                        @if (count($sub2->almacenes) > 0)
                                                            <ul>
                                                                @foreach ($sub2->almacenes as $sub3)
                                                                    <li style="cursor: pointer">{{ $sub3->nombre }}
                                                                        &nbsp;
                                                                        <a href="javascript:void(0);"
                                                                            class="btn_AlmacenAdd"
                                                                            data-id="{{ $sub3->id }}"
                                                                            data-name="{{ $sub3->nombre }}"
                                                                            title="Seleccionar">
                                                                            <i class="fa fa-check"></i>
                                                                        </a>
                                                                        @if (count($sub3->almacenes) > 0)
                                                                            <ul>
                                                                                @foreach ($sub3->almacenes as $sub4)
                                                                                    <li style="cursor: pointer">
                                                                                        {{ $sub4->nombre }}
                                                                                        &nbsp;
                                                                                        <a href="javascript:void(0);"
                                                                                            class="btn_AlmacenAdd"
                                                                                            data-id="{{ $sub4->id }}"
                                                                                            data-name="{{ $sub4->nombre }}"
                                                                                            title="Seleccionar">
                                                                                            <i class="fa fa-check"></i>
                                                                                        </a>
                                                                                        @if (count($sub4->almacenes) > 0)
                                                                                            <ul>
                                                                                                @foreach ($sub4->almacenes as $sub5)
                                                                                                    <li
                                                                                                        style="cursor: pointer">
                                                                                                        {{ $sub5->nombre }}
                                                                                                        &nbsp;
                                                                                                        <a href="javascript:void(0);"
                                                                                                            class="btn_AlmacenAdd"
                                                                                                            data-id="{{ $sub5->id }}"
                                                                                                            data-name="{{ $sub5->nombre }}"
                                                                                                            title="Seleccionar">
                                                                                                            <i
                                                                                                                class="fa fa-check"></i>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        @endif
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /col -->
                    </div>
                    <br>
                    <button class="btn btn-primary btn-block" id="AceptarBodegaAdd">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:void(0);" class="btn-flotante" data-bs-target="#modalSelect" data-bs-toggle="modal"
        data-bs-effect="effect-scale">Filtros</a>
    </div>

    @php
        $data = file_get_contents('facturas_compra.json');
        $facturas = json_decode($data, true);
    @endphp
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let proveedores = @json($proveedores);
            let centros_costos = @json($centros_costos);
            var productos = @json($productos);
            var formas_pago = @json($formas_pago);
            var cuentas_gastos = @json($cuentas_gastos);
            var impuestos_cargos = @json($impuestos_cargos);
            var impuestos_retencion = @json($impuestos_retencion);
            let facturas_compra = @json($facturas);

            localStorage.setItem('productos', JSON.stringify(productos));
            localStorage.setItem('formas_pago', JSON.stringify(formas_pago));
            localStorage.setItem('cuentas_gastos', JSON.stringify(cuentas_gastos));
            localStorage.setItem('impuestos_cargos', JSON.stringify(impuestos_cargos));
            localStorage.setItem('impuestos_retencion', JSON.stringify(impuestos_retencion));
            localStorage.setItem('centros_costos', JSON.stringify(centros_costos));
            localStorage.setItem('proveedores', JSON.stringify(proveedores));
            localStorage.setItem('facturas_compra_siigo', JSON.stringify(facturas_compra));
        });
    </script>
    <script src="{{ asset('assets/plugins/treeview/treeview.js') }}"></script>
    <script src="{{ asset('assets/js/app/contabilidad/compras/factura_compra.js') }}"></script>
@endsection
