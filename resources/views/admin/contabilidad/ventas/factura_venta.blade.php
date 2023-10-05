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
            padding: 0.25em 0.5em; /* Ajusta el padding según tus preferencias */
            font-size: 12px; /* Tamaño de fuente */
            font-weight: bold; /* Peso de la fuente */
            border-radius: 4px; /* Borde redondeado */
            background-color: #ffc107; /* Color de fondo */
            color: #000; /* Color del texto */
        }

        /* Estilo para el badge de éxito */
        .badge-success {
            background-color: #28a745; /* Color de fondo para el éxito */
            color: #fff; /* Color del texto para el éxito */
        }

        /* Estilo para el badge de advertencia */
        .badge-warning {
            background-color: #ffc107; /* Color de fondo para la advertencia */
            color: #000; /* Color del texto para la advertencia */
        }

        /* Estilo para el badge de error */
        .badge-danger {
            background-color: #dc3545; /* Color de fondo para el error */
            color: #fff; /* Color del texto para el error */
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
                        <li class="breadcrumb-item active" aria-current="page"> Facturas de venta</li>
                    </ol>
                </nav>
            </div>
        </div>
        @if ($view_alert == 1)
            <div class="alert alert-danger mb-2" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"> Quedan pocos números disponibles en la numeración de
                    facturación autorizada por la DIAN</span>
            </div>
        @elseif($view_alert == 2)
            <div class="alert alert-danger mb-2" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"> La fecha de vigencia de la numeración de facturación autorizada por la
                    DIAN esta próxima a vencer</span>
            </div>
        @endif

        @if ($disabled_fv == 1)
            <div class="alert alert-danger mb-2" role="alert">
                <span class="alert-inner--icon"><i class="fe fe-info"></i></span>
                <span class="alert-inner--text"> La numeración de facturación autorizada por la DIAN esta vencida</span>
            </div>
        @endif
        <!-- /breadcrumb -->
        <div class="row row-sm" id="div_general">
            <div class="col-md-12 col-xl-4">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Facturas de venta</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <button @if ($disabled_fv == 1) disabled @endif class="btn btn-primary"
                                    id="btnNew">+</button>
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
                                                $fecha_vencimiento = date('Y-m-d', strtotime($factura->fecha_elaboracion . ' + 30 days'));
                                                $fecha_actual = date('Y-m-d');
                                                $color = '';
                                                // Convierte ambas fechas en objetos DateTime
                                                $fecha_vencimiento_obj = new DateTime($fecha_vencimiento);
                                                $fecha_actual_obj = new DateTime($fecha_actual);

                                                // Calcula la diferencia entre las fechas
                                                $diferencia = $fecha_actual_obj->diff($fecha_vencimiento_obj);

                                                // Obtiene el número de días pasados
                                                $dias_pasados = $diferencia->days;

                                                // Si van menos de 20 días, poner en verde
                                                if ($dias_pasados < 20) {
                                                    $color = 'badge-success';
                                                } else if ($dias_pasados < 28) {
                                                    $color = 'badge-warning';
                                                } else {
                                                    $color = 'badge-danger';
                                                }
                                            @endphp
                                            <h6><span>Factura No. FE-{{ $factura->numero }}@if($bg == 'bg-pending')<badge
                                                        class="badge {{ $color }}">{{ $dias_pasados }}</badge>@endif</span>
                                                <span>{{ $factura->valor_total }}
                                                    @if ($factura->favorito == 0)
                                                        <i data-id="{{ $factura->id }}"
                                                            class="far fa-star btn_favorite"></i>
                                            @else
                                                <i data-id="{{ $factura->id }}"
                                                    class="fas fa-star btn_favorite orange"></i>
                                    @endif
                                    
                                        @if ($factura->visto_bueno == 0)
                                                <i data-id="{{ $factura->id }}"
                                                    class="far fa-check-circle @if (auth()->user()->hasPermissionTo('contabilidad_visto_bueno')) btn_visto_bueno @endif"></i>
                                        </span>
                                        @else
                                            <i data-id="{{ $factura->id }}"
                                                class="fas fa-check-circle @if (auth()->user()->hasPermissionTo('contabilidad_visto_bueno')) btn_visto_bueno @endif orange"></i></span>
                                        
                                    @endif
                                </span>
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
                        <h1 class="invoice-title">FACTURA VENTA</h1>
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
                                    <h6 id="cliente_view">EDATEL TIGO</h6>
                                    <p id="nit_view">Nit 890.905.065-2<br>
                                        Tel: (034) 3846500<br>
                                        Medellín - Colombia</p>
                                </div>
                            </div>
                            <div class="col-md">
                                <label class="tx-gray-600">Información de la factura</label>
                                <p class="invoice-info-row"><span>Factura No.</span> <span id="num_fact_view">1743</span>
                                </p>
                                <p class="invoice-info-row"><span>Fecha Venta</span> <span
                                        id="compra_view">21/03/2023</span></p>
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
                        <hr>
                        <div style="display: flex; justify-content: center;">
                            <a class="btn btn-success btn_pago_factura" data-id="0" style="margin-right: 10px;"
                                href="javascript:void(0);">Recibir Pago</a>

                            <a class="btn btn-primary btn_imprimir_factura" style="margin-right: 10px;" target="_blank"
                                href="{{ route('pdf_factura_venta') }}?token=0">Descargar e
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
                            <h3 class="card-title">Nueva factura de venta</h3>
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
                                        <option value="1">FV-1 Factura Electónica de Venta</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <label for="">Fecha elaboración</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_add"
                                        placeholder="Fecha elaboración" type="date">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Vendedor</label>
                                    <select class="form-select" id="vendedor_add">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($usuarios as $usuario)
                                            @if ($usuario->id == auth()->user()->id)
                                                <option value="{{ $usuario->id }}" selected>{{ $usuario->nombre }}
                                                </option>
                                            @else
                                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Consecutivo</label>
                                    <input id="consecutivo_add" class="form-control"
                                        placeholder="Consecutivo" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg-6">
                                    <label for="">Cliente</label>
                                    <select class="form-select" id="cliente_add">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                ({{ $cliente->nit }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label for="">Contacto</label>
                                    <input class="form-control" disabled id="contacto_add" placeholder="Contacto"
                                        type="text">
                                </div>
                            </div>
                            <div class="row row-sm mt-5">
                                <div class="table-responsive">
                                    <table id="tbl_data_detail"
                                        class="table border-top-0 table-bordered text-nowrap border-bottom">
                                        <thead>
                                            <tr class="bg-gray">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Descripción</th>
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
                                                    <select class="form-select producto_add">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($productos as $producto)
                                                            <option value="{{ $producto->id }}">
                                                                {{ $producto->nombre }}
                                                                ({{ $producto->marca }} - {{ $producto->modelo }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <textarea placeholder="Seriales (Opcional)" class="form-control text-uppercase seriales_add" cols="30" rows="5"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="7"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <input type="number" placeholder="Cantidad" step="1"
                                                        min="1" value="1"
                                                        class="form-control text-end cantidad_add" style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Valor Unitario" value="0.00"
                                                        class="form-control text-end valor_add input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Descuento" value="0.00"
                                                        class="form-control text-end descuento_add input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select cargo_add">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_cargos as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select retencion_add">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_retencion as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
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
                                        <div class="col-lg-12 mt-5 d-flex" style="justify-content: end">
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
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="retefte_add" class="form-control text-end" type="text" title="Rte Fte: (%)" placeholder="Rte Fte: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_retefte_add">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="reteiva_add" class="form-control text-end" type="text" title="Rte Iva: (%)" placeholder="Rte Iva: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_reteiva_add">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="reteica_add" class="form-control text-end" type="text" title="Rte Ica: (%)" placeholder="Rte Ica: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_reteica_add">0.00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
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
                                    <textarea class="form-control" id="observaciones_add" placeholder="Observaciones" rows="5"
                                        style="resize: none">VR05 VERSIÓN: 01 06/01/2020
FAVOR CONSIGNAR EN LA CUENTA DE AHORROS BANCOLOMBIA 10825335162 A
NOMBRE DE RADIO ENLACE S.A.S.
Enviar comprobante de pago al correo facturacionelectronica@radioenlacesas.com
Autorretenedores de ICA en el municipio de Medellín según Resolución 202050056223
de 2020
Esta factura de Venta constituye título valor según la Ley 1231 del 17 de Julio de 2008,
El no pago de esta generará intereses por mora
mensual a la tasa máxima legal autorizada. En caso de NO PAGO se procederá a
reportarse en las centrales de crédito.</textarea>
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
                            <h3 class="card-title">Modificar factura de venta</h3>
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
                                        <option value="1">FV-1 Factura Electónica de Venta</option>
                                    </select>
                                </div>

                                <div class="col-lg-3">
                                    <label for="">Fecha elaboración</label>
                                    <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_edit"
                                        placeholder="Fecha elaboración" type="date">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Vendedor</label>
                                    <select class="form-select" id="vendedor_edit">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($usuarios as $usuario)
                                            @if ($usuario->id == auth()->user()->id)
                                                <option value="{{ $usuario->id }}" selected>{{ $usuario->nombre }}
                                                </option>
                                            @else
                                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Consecutivo</label>
                                    <input id="consecutivo_edit" class="form-control" value="{{ $num_factura }}" disabled
                                        placeholder="Consecutivo" type="text">
                                </div>
                            </div>
                            <br>
                            <div class="row row-sm">
                                <div class="col-lg-6">
                                    <label for="">Cliente</label>
                                    <select class="form-select" id="cliente_edit">
                                        <option value="">Seleccione una opción</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                ({{ $cliente->nit }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label for="">Contacto</label>
                                    <input class="form-control" disabled id="contacto_edit" placeholder="Contacto"
                                        type="text">
                                </div>
                            </div>
                            <div class="row row-sm mt-5">
                                <div class="table-responsive">
                                    <table id="tbl_data_detail_edit"
                                        class="table border-top-0 table-bordered text-nowrap border-bottom">
                                        <thead>
                                            <tr class="bg-gray">
                                                <th class="text-center">#</th>
                                                <th class="text-center">Producto</th>
                                                <th class="text-center">Descripción</th>
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
                                                    <select class="form-select producto_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($productos as $producto)
                                                            <option value="{{ $producto->id }}">
                                                                {{ $producto->nombre }}
                                                                ({{ $producto->marca }} - {{ $producto->modelo }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <textarea placeholder="Seriales (Opcional)" class="form-control text-uppercase seriales_edit" cols="30" rows="5"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <textarea placeholder="Descripción" class="form-control descripcion_edit" style="border: 0" rows="7"></textarea>
                                                </td>
                                                <td class="pad-4">
                                                    <input type="number" placeholder="Cantidad" step="1"
                                                        min="1" value="1"
                                                        class="form-control text-end cantidad_edit" style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Valor Unitario" value="0.00"
                                                        class="form-control text-end valor_edit input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <input type="text" placeholder="Descuento" value="0.00"
                                                        class="form-control text-end descuento_edit input_dinner"
                                                        style="border: 0">
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select cargo_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_cargos as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="pad-4">
                                                    <select class="form-select retencion_edit">
                                                        <option value="">Seleccione una opción</option>
                                                        @foreach ($impuestos_retencion as $impuesto)
                                                            <option data-impuesto="{{ $impuesto->tarifa }}"
                                                                value="{{ $impuesto->id }}">{{ $impuesto->nombre }}</option>
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
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="retefte_edit" class="form-control text-end" type="text" title="Rte Fte: (%)" placeholder="Rte Fte: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_retefte_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="reteiva_edit" class="form-control text-end" type="text" title="Rte Iva: (%)" placeholder="Rte Iva: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_reteiva_edit">0.00</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-flex" style="justify-content: end">
                                            <div class="text-end col-2">
                                                <input id="reteica_edit" class="form-control text-end" type="text" title="Rte Ica: (%)" placeholder="Rte Ica: (%)">
                                            </div>
                                            <div class="text-end col-4">
                                                <p class="font-20" id="total_reteica_edit">0.00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
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
                                    <textarea class="form-control" id="observaciones_edit" placeholder="Observaciones" rows="5"
                                        style="resize: none">VR05 VERSIÓN: 01 06/01/2020
FAVOR CONSIGNAR EN LA CUENTA DE AHORROS BANCOLOMBIA 10825335162 A
NOMBRE DE RADIO ENLACE S.A.S.
Enviar comprobante de pago al correo facturacionelectronica@radioenlacesas.com
Autorretenedores de ICA en el municipio de Medellín según Resolución 202050056223
de 2020
Esta factura de Venta constituye título valor según la Ley 1231 del 17 de Julio de 2008,
El no pago de esta generará intereses por mora
mensual a la tasa máxima legal autorizada. En caso de NO PAGO se procederá a
reportarse en las centrales de crédito.</textarea>
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
                            <label for="">Cliente</label>
                            <select class="form-select" id="cliente_select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }} -
                                        ({{ $cliente->nit }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="">Estado</label>
                            <select class="form-select" id="estado_select">
                                <option value="">Seleccione una opción</option>
                                <option value="1">Pendiente</option>
                                <option value="2">Pagada</option>
                                <!--<option value="0">Anulada</option>-->
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Producto / Servicio</label>
                            <select class="form-select" id="producto_select">
                                <option value="">Seleccione una opción</option>
                                @foreach ($productos as $producto)
                                    <option value="{{ $producto->id }}">
                                        {{ $producto->nombre }}
                                        ({{ $producto->marca }} - {{ $producto->modelo }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="">Número Factura</label>
                            <input type="number" placeholder="Número Factura" class="form-control" id="num_factura_select">
                        </div>
                        <!--<div class="col-lg">
                            <label for="">Serial (Producto)</label>
                            <input type="number" placeholder="Serial (Producto)" class="form-control"
                                id="serial_factura_select">
                        </div>-->
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Consecutivo Inicio</label>
                            <input type="number" placeholder="Consecutivo Inicio" class="form-control" id="cons_inicio_select">
                        </div>
                        <div class="col-lg">
                            <label for="">Consecutivo Fin</label>
                            <input type="number" placeholder="Consecutivo Fin" class="form-control" id="cons_fin_select">
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
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Mayor o menor (Días después de la fecha de elaboración)</label>
                            <select class="form-select" id="mayor_menor_select">
                                <option value="">Seleccione una opción</option>
                                <option value="1">Mayor</option>
                                <option value="2">Menor</option>
                            </select>
                        </div>
                        <div class="col-lg">
                            <label for="">Días de elaboración</label>
                            <input type="number" placeholder="Día de mora" class="form-control" id="dia_mora_select">
                        </div>
                    </div>
                    <br>
                    <br>
                    <button class="btn btn-primary btn-block" id="btn_filtrar">Filtrar</button>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('factura_venta') }}" id="btn_clear">Limpiar filtros</a>
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
        $(document).ready(function() {
            var productos = @json($productos);
            var formas_pago = @json($formas_pago);
            var impuestos_cargos = @json($impuestos_cargos);
            var impuestos_retencion = @json($impuestos_retencion);

            localStorage.setItem('productos', JSON.stringify(productos));
            localStorage.setItem('formas_pago', JSON.stringify(formas_pago));
            localStorage.setItem('impuestos_cargos', JSON.stringify(impuestos_cargos));
            localStorage.setItem('impuestos_retencion', JSON.stringify(impuestos_retencion));
        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/ventas/factura_venta.js') }}"></script>
@endsection
