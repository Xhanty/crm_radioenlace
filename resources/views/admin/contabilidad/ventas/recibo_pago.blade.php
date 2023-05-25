@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Contabilidad</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ventas / Recibo de pago</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Add -->
        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title">Nueva recibo de pago</h3>
                            </div>
                            <div class="div-2-tables-header" style="margin-bottom: 13px">
                                <a href="{{ route('factura_venta') }}" class="btn btn-primary back_home">x</a>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="card-body" style="margin-top: -18px;">
                                <input type="hidden" id="vlv_pagar" disabled readonly>
                                <input type="hidden" id="id_add" value="{{ $factura->id }}" disabled readonly>
                                <div class="row row-sm">
                                    <div class="col-lg-4">
                                        <label for="">Tipo</label>
                                        <select class="form-select" id="tipo_add">
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">(RP-1) Recibo Pago</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Fecha elaboración</label>
                                        <input class="form-control" value="{{ date('Y-m-d') }}" id="fecha_add"
                                            placeholder="Fecha elaboración" type="date">
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="">Número</label>
                                        <input class="form-control text-center" value="{{ $num_egreso }}" disabled
                                            id="numero_add" placeholder="Número" type="text">
                                    </div>
                                </div>
                                <br>
                                <div class="row row-sm">
                                    <div class="col-lg-4">
                                        <label for="">Cliente / otros</label>
                                        <select class="form-select" id="proveedor_add" disabled>
                                            <option value="">Seleccione una opción</option>
                                            @foreach ($clientes as $cliente)
                                                @if ($factura->cliente_id == $cliente->id)
                                                    <option value="{{ $cliente->id }}" selected>
                                                        {{ $cliente->razon_social }}
                                                        ({{ $cliente->nit }})
                                                    </option>
                                                @else
                                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                                        ({{ $cliente->nit }})
                                                    </option>
                                                @endif
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
                                        <label for="">De donde sale el dinero</label>
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
                                        <input class="form-control input_dinner" style="text-align: right;" value="0.00"
                                            id="valor_add" placeholder="Número" type="text">
                                    </div>
                                </div>
                                <div class="row row-sm mt-3">
                                    <div class="table-responsive">
                                        <table id="tbl_data_detail"
                                            class="table border-top-0 table-bordered text-nowrap border-bottom">
                                            <thead>
                                                <tr class="bg-gray">
                                                    <th class="text-center"><input type="checkbox" checked id="check_all">
                                                    </th>
                                                    <th class="text-center">Factura</th>
                                                    <th class="text-center">Cuota</th>
                                                    <th class="text-center">Saldo Total</th>
                                                    <th class="text-center">Saldo a Pagar</th>
                                                    <th class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="background: #f9f9f9;">
                                                    <td class="text-center pad-4"><input type="checkbox" checked
                                                            class="check_fc">
                                                    </td>
                                                    <td class="text-center pad-4">FE-{{ $factura->numero }}</td>
                                                    <td class="text-center pad-4" id="cuota_pagar">1</td>
                                                    <td class="text-center pad-4">
                                                        {{ $factura->valor_total }}</td>
                                                    <td class="text-center pad-4" id="tlt_valor">
                                                        {{ $factura->valor_total }}</td>
                                                    <td class="text-center pad-4" id="td_valor_pagado">0.00</td>
                                                </tr>
                                            </tbody>
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

        <!-- View -->
        <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
                <div class=" main-content-body-invoice">
                    <div class="card card-invoice">
                        <div class="card-header ps-3 pe-3 pt-3 pb-0 d-flex-header-table">
                            <div class="div-1-tables-header">
                                <h3 class="card-title" id="car_tlt_info">Recibos de pago (Abonos)</h3>
                            </div>
                        </div>
                        <div class="p-0">
                            <div class="card-body" style="margin-top: -18px;">
                                <div class="row row-sm mt-3">
                                    <div class="table-responsive">
                                        <table
                                            class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                            <thead>
                                                <tr class="bg-gray">
                                                    <th class="text-center">Recibo Pago</th>
                                                    <th class="text-center">Cuota</th>
                                                    <th class="text-center">Valor</th>
                                                    <th class="text-center">Usuario</th>
                                                    <th class="text-center">Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pagos as $key => $value)
                                                    <tr>
                                                        <td class="text-center">RP-{{ $value->numero }}</td>
                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                        <td class="text-center">{{ $value->valor }}</td>
                                                        <td class="text-center">{{ $value->creador }}</td>
                                                        <td class="text-center">
                                                            {{ date('d-m-Y', strtotime($value->fecha_elaboracion)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
        $(function() {
            let valor_pagar = 0;
            let pagos = @json($pagos);

            if (pagos.length < 1) {
                let valor_factura = $("#tlt_valor").text();

                valor_factura = valor_factura.split(',');
                valor_factura = valor_factura[0];
                valor_factura = valor_factura.replaceAll('.', '');
                valor_factura = parseInt(valor_factura);

                valor_pagar = valor_factura;
                $("#cuota_pagar").html(1);
                $("#car_tlt_info").html('Recibos de pago (Abonos)');
            } else {
                let valor_general = 0;
                let valor_factura = $("#tlt_valor").text();

                valor_factura = valor_factura.split(',');
                valor_factura = valor_factura[0];
                valor_factura = valor_factura.replaceAll('.', '');
                valor_factura = parseInt(valor_factura);

                let valor_pagado = 0;
                let count = 0;

                pagos.forEach(pago => {
                    let valor = pago.valor;
                    valor = valor.split(',');
                    valor = valor[0];
                    valor = valor.replaceAll('.', '');
                    valor = parseInt(valor);

                    valor_pagado += valor;
                    count++;
                });

                $("#car_tlt_info").html('Recibos de pago (Abonos = ' + (valor_pagado).toLocaleString('es-ES', {
                    minimumFractionDigits: 2
                }) + ')');

                valor_general = valor_factura - valor_pagado;

                valor_pagar = valor_general;

                $("#tlt_valor").html((valor_general).toLocaleString('es-ES', {
                    minimumFractionDigits: 2
                }));

                $("#cuota_pagar").html(count + 1);
            }

            $("#vlv_pagar").val(valor_pagar);
        });
    </script>
    <script src="{{ asset('assets/js/app/contabilidad/ventas/recibo_pago.js') }}"></script>
@endsection
