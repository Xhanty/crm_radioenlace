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
    <input type="hidden" disabled readonly id="id_factura_nt_fv" value="{{ $factura->id }}">
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Nota crédito</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Aplicar nota crédito</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <a href="{{ route('factura_venta') }}" class="btn btn-primary">x</a>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="card-body" style="margin-top: -18px;">
                                <input type="hidden" disabled readonly id="id_factura_edit">
                                <div class="row row-sm">
                                    <div class="col-lg-3">
                                        <label for="">Tipo</label>
                                        <select class="form-select" id="tipo_nc_edit">
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">NC-2 Nota Crédito</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Fecha elaboración</label>
                                        <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_nc_edit"
                                            placeholder="Fecha elaboración" type="date">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Usuario</label>
                                        <select class="form-select" id="vendedor_nc_edit">
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
                                        <input id="consecutivo_nc_edit" class="form-control" value="{{ $num_consecutivo }}" placeholder="Consecutivo" type="text">
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <label for="">Motivo</label>
                                        <select class="form-select" id="motivo_nc_edit">
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Devolución de parte de los bienes; no aceptación de partes del servicio</option>
                                            <option value="2">Anulación de la factura electrónica</option>
                                            <option value="3">Rebaja o descuento parcial o total</option>
                                            <option value="4">Ajuste de precio</option>
                                            <option value="5">Otros</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg-3">
                                        <label for="">Tipo</label>
                                        <select class="form-select" id="tipo_edit" disabled>
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">FV-1 Factura Electónica de Venta</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="">Fecha elaboración factura</label>
                                        <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_edit" disabled
                                            placeholder="Fecha elaboración" type="date">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Usuario</label>
                                        <select class="form-select" id="vendedor_edit" disabled>
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
                                        <label for="">Consecutivo Factura</label>
                                        <input id="consecutivo_edit" class="form-control" value="{{ $num_consecutivo }}"
                                            disabled placeholder="Consecutivo" type="text">
                                    </div>
                                </div>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg-6">
                                        <label for="">Cliente</label>
                                        <select class="form-select" id="cliente_edit" disabled>
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
                                                        <textarea placeholder="Seriales (Opcional)" class="form-control text-uppercase seriales_edit" cols="30"
                                                            rows="5"></textarea>
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
                                                        <input type="text" placeholder="Valor Unitario" value=""
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
                                                    <input id="retefte_edit" class="form-control text-end" type="text"
                                                        title="Rte Fte: (%)" placeholder="Rte Fte: (%)">
                                                </div>
                                                <div class="text-end col-4">
                                                    <p class="font-20" id="total_retefte_edit">0.00</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 d-flex" style="justify-content: end">
                                                <div class="text-end col-2">
                                                    <input id="reteiva_edit" class="form-control text-end" type="text"
                                                        title="Rte Iva: (%)" placeholder="Rte Iva: (%)">
                                                </div>
                                                <div class="text-end col-4">
                                                    <p class="font-20" id="total_reteiva_edit">0.00</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 d-flex" style="justify-content: end">
                                                <div class="text-end col-2">
                                                    <input id="reteica_edit" class="form-control text-end" type="text"
                                                        title="Rte Ica: (%)" placeholder="Rte Ica: (%)">
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
                                    <button class="btn btn-primary" id="btnEditFactura">Guardar Nota Crédito</button>
                                </div>
                            </div>
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
            var productos = @json($productos);
            var formas_pago = @json($formas_pago);
            var impuestos_cargos = @json($impuestos_cargos);

            localStorage.setItem('productos', JSON.stringify(productos));
            localStorage.setItem('formas_pago', JSON.stringify(formas_pago));
            localStorage.setItem('impuestos_cargos', JSON.stringify(impuestos_cargos));
        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/ventas/nota_credito.js') }}"></script>
@endsection
