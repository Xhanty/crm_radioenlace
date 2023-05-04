@extends('layouts.menu')

@section('content')
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
                                <button class="btn btn-primary" id="btnNew">+</button>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="main-invoice-list" id="mainInvoiceList">
                                @foreach ($facturas as $key => $factura)
                                    @if ($key == 0)
                                        <div class="media factura_btn" data-id="{{ $factura->id }}">
                                            <div class="media-icon">
                                                <i class="far fa-file-alt"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6><span>Factura No.{{ $factura->numero }}</span>
                                                    <span>{{ $factura->valor_total }}</span>
                                                </h6>
                                                <div>
                                                    <p><span>Fecha:</span>
                                                        {{ date('d/m/Y', strtotime($factura->fecha_elaboracion)) }}</p>
                                                    <p>{{ $factura->razon_social }} (NIT:
                                                        {{ $factura->nit }}-{{ $factura->codigo_verificacion }})</p>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="media factura_btn" data-id="{{ $factura->id }}">
                                            <div class="media-icon">
                                                <i class="far fa-file-alt"></i>
                                            </div>
                                            <div class="media-body">
                                                <h6><span>Factura No.{{ $factura->numero }}</span>
                                                    <span>{{ $factura->valor_total }}</span>
                                                </h6>
                                                <div>
                                                    <p><span>Fecha:</span>
                                                        {{ date('d/m/Y', strtotime($factura->fecha_elaboracion)) }}</p>
                                                    <p>{{ $factura->razon_social }} (NIT:
                                                        {{ $factura->nit }}-{{ $factura->codigo_verificacion }})</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
                                            <h6 id="proveedor_view">EDATEL TIGO</h6>
                                            <p id="nit_view">Nit 890.905.065-2<br>
                                                Tel: (034) 3846500<br>
                                                Medellín - Colombia</p>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <label class="tx-gray-600">Información de la factura</label>
                                        <p class="invoice-info-row"><span>Factura No.</span> <span
                                                id="num_fact_view">1743</span></p>
                                        <p class="invoice-info-row"><span>Fecha Compra</span> <span
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
                                                <th class="tx-right">Valor Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productos_view"></tbody>
                                    </table>
                                </div>
                                <hr>
                                <a class="btn btn-primary btn-block" target="_blank"
                                    href="{{ route('pdf_factura_compra') }}?token=1">Generar PDF</a>
                            </div>
                            <div id="content_loader" class="d-none">
                                <div class="text-center">
                                    <div class="spinner-border" role="status" style="color: #3858f9">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- COL-END -->
        </div>

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
                                            <option value="1">FV - 2 - Factura Electónica de Venta</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Número</label>
                                        <input class="form-control" value="{{ $num_factura }}" disabled placeholder="Número" type="text">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="">Fecha elaboración</label>
                                        <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_add" placeholder="Fecha elaboración"
                                            type="date">
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
                                                    <th class="text-center">Bodega</th>
                                                    <th class="text-center">Cant</th>
                                                    <th class="text-center">Valor Unitario</th>
                                                    <th class="text-center">Descuento</th>
                                                    <th class="text-center">Impuestos</th>
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
                                                    </td>
                                                    <td class="pad-4">
                                                        <textarea placeholder="Descripción" class="form-control descripcion_add" style="border: 0" rows="2"></textarea>
                                                    </td>
                                                    <td class="pad-4">
                                                        <input type="text" placeholder="Bodega"
                                                            class="form-control bodega_add" style="border: 0">
                                                    </td>
                                                    <td class="pad-4">
                                                        <input type="number" placeholder="Cantidad" step="1" min="1" value="1"
                                                            class="form-control text-end cantidad_add" style="border: 0">
                                                    </td>
                                                    <td class="pad-4">
                                                        <input type="text" placeholder="Valor Unitario" value="0.00"
                                                            class="form-control text-end valor_add input_dinner" style="border: 0">
                                                    </td>
                                                    <td class="pad-4">
                                                        <input type="text" placeholder="Descuento" value="0.00"
                                                            class="form-control text-end descuento_add input_dinner" style="border: 0">
                                                    </td>
                                                    <td class="pad-4">
                                                        <select class="form-select cargo_add">
                                                            <option value="">Seleccione una opción</option>
                                                            <option value="1">IVA 19%</option>
                                                            <option value="2">Iva Serv 19%</option>
                                                            <option value="3">IVA 16%</option>
                                                            <option value="4">IVA 5%</option>
                                                            <option value="5">Impoconsumo 8%</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center d-flex pad-4">
                                                        <input disabled type="text" placeholder="0.00"
                                                            class="form-control text-end total_add input_dinner" style="border: 0">
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
                                                <div style="width: 100%; margin-right: 24%" class="text-end">
                                                    <p class="font-20">Subtotal:</p>
                                                </div>
                                                <div>
                                                    <p class="font-20" id="total_subtotal_add">0.00</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 d-flex" style="justify-content: end">
                                                <div style="width: 100%; margin-right: 24%" class="text-end">
                                                    <p class="font-20">Descuentos:</p>
                                                </div>
                                                <div>
                                                    <p class="font-20" id="total_descuentos_add">0.00</p>
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
                                <div class="text-center mt-5">
                                    <button class="btn btn-primary" id="btnAddFactura">Guardar Factura</button>
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

            localStorage.setItem('productos', JSON.stringify(productos));
            localStorage.setItem('formas_pago', JSON.stringify(formas_pago));
        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/ventas/factura_venta.js') }}"></script>
@endsection
