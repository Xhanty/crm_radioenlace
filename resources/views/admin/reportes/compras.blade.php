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
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Reportes</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Compras</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <div class="row row-sm">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Cantidad Facturas</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold">{{ count($facturas) }}</span></h4>
                            </div>
                            <div class="card-chart bg-pink-transparent brround ms-auto mt-0">
                                <i class="typcn typcn-chart-line-outline text-pink tx-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Cargos (Iva)</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold" id="cargos_facturas">400.600,00</h4>
                            </div>
                            <div class="card-chart bg-teal-transparent brround ms-auto mt-0 btn_cargos"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-chart-bar-outline text-teal tx-20"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Retenciones</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold" id="retenciones_facturas">302.450,00</h4>
                            </div>
                            <div class="card-chart bg-purple-transparent brround ms-auto mt-0 btn_retenciones"
                                style="cursor: pointer;" title="Ver Detalle">
                                <i class="typcn typcn-time  text-purple tx-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <div class="card-body iconfont text-start">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">Totales</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <div class="d-flex mb-0">
                            <div class="">
                                <h4 class="mb-1 font-weight-bold" id="totales_facturas">48.000.000,00</h4>
                            </div>
                            <div class="card-chart bg-purple-transparent brround ms-auto mt-0">
                                <i class="typcn typcn-time  text-purple tx-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->

        <div class="row row-sm">
            <div class="col-md-12 col-lg-12 col-xl-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title pt-2">Proveedores</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-0">Proveedores con más compras realizadas.</p>
                    </div><!-- card-header -->
                    <div class="card-body p-0">
                        <div class="browser-stats" id="div_proveedores_factura"></div>
                    </div>
                </div><!-- card -->
            </div>
            <div class="col-md-12 col-lg-12 col-xl-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title pt-2">Empleados</h4>
                            <i class="mdi mdi-dots-Vertical"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-0">Empleados con más compras realizadas.</p>
                    </div><!-- card-header -->
                    <div class="card-body p-0">
                        <div class="browser-stats" id="div_empleados_factura"></div>
                    </div>
                </div><!-- card -->
            </div>
        </div>

        <div class="row row-sm d-none" id="div_impuestos_cargo">
            <div class="col-md-12 col-xl-12">
                <div class="card overflow-hidden review-project">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-10">Cargos (IVA)</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 text-muted mb-3">Listado Impuesto a Cargo.</p>
                        <div class="table-responsive mb-0">
                            <table
                                class="table table-hover table-bordered mb-0 text-md-nowrap text-lg-nowrap text-xl-nowrap table-striped ">
                                <thead>
                                    <tr>
                                        <th>Impuesto</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_impuesto_cargo">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-sm d-none" id="div_impuestos_retenciones">
            <div class="col-md-12 col-xl-12">
                <div class="card overflow-hidden review-project">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-10">Retenciones</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 text-muted mb-3">Listado Impuesto a Retención.</p>
                        <div class="table-responsive mb-0">
                            <table
                                class="table table-hover table-bordered mb-0 text-md-nowrap text-lg-nowrap text-xl-nowrap table-striped ">
                                <thead>
                                    <tr>
                                        <th>Impuesto</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl_impuesto_retencion">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-sm ">
            <div class="col-md-12 col-xl-12">
                <div class="card overflow-hidden review-project">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-10">Facturas</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 text-muted mb-3">Listado de facturas registradas en el software.</p>
                        <div class="table-responsive mb-0">
                            <table
                                class="table table-hover table-bordered mb-0 text-md-nowrap text-lg-nowrap text-xl-nowrap table-striped ">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Factura</th>
                                        <th>Proveedor</th>
                                        <th>Fecha Compra</th>
                                        <th>Fecha Vencimiento</th>
                                        <th>Valor</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($facturas as $key => $factura)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <div class="project-contain">
                                                    <h6 class="mb-1 tx-13"><a target="_blank"
                                                            href="{{ route('pdf_factura_compra') }}?token={{ $factura->id }}">Factura
                                                            No.
                                                            {{ $factura->numero }}</a>
                                                    </h6>
                                                </div>
                                            </td>
                                            <td>{{ $factura->razon_social }}
                                                ({{ $factura->nit }}-{{ $factura->codigo_verificacion }})
                                            </td>
                                            <td>{{ date('d/m/Y', strtotime($factura->fecha_elaboracion)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($factura->fecha_vencimiento)) }}</td>
                                            <td>{{ $factura->valor_total }}</td>
                                            @if ($factura->status == 2)
                                                <td><span class="badge bg-success-gradient">Con Pago</span></td>
                                            @elseif($factura->status == 0)
                                                <td><span class="badge bg-warning-gradient">Reversado</span></td>
                                            @else
                                                <td><span class="badge bg-danger-gradient">Sin Pago</span></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                <label for=""># Factura</label>
                                <input type="number" placeholder="# Factura" class="form-control" id="factura_select">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Proveedor</label>
                                <select class="form-select" id="proveedor_select">
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}
                                            ({{ $proveedor->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Empleado</label>
                                <select class="form-select" id="empleado_select">
                                    <option value="">Seleccione un empleado</option>
                                    @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id }}">{{ $empleado->nombre }}</option>
                                    @endforeach
                                </select>
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

        <a href="javascript:void(0);" class="btn-flotante" data-bs-target="#modalSelect" data-bs-toggle="modal"
            data-bs-effect="effect-scale">Filtros</a>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/reportes/compras.js') }}"></script>
    <script>
        $(document).ready(function() {
            let facturas = @json($facturas);

            let impuestos_1 = [];
            let cargos = 0;

            let impuestos_2 = [];
            let retenciones = 0;

            let proveedores = [];

            let empleados = [];

            let totales = 0;

            facturas.forEach(factura => {
                let total = factura.valor_total;
                let impuesto_1 = JSON.parse(factura.impuestos_1);
                let impuesto_2 = JSON.parse(factura.impuestos_2);

                if (impuesto_1) {
                    impuestos_1.push(impuesto_1[0]);
                }

                if (impuesto_2) {
                    impuestos_2.push(impuesto_2[0]);
                }

                total = total.split(',');
                total = total[0];

                total = parseInt(total.replaceAll('.', ''));
                totales += total;

                proveedores.push(factura.razon_social + ' (' + factura.nit + '-' + factura
                    .codigo_verificacion + ')');
                empleados.push(factura.empleado);
            });

            const dataArr = new Set(proveedores);
            const dataArr2 = new Set(empleados);

            proveedores = [...dataArr];
            empleados = [...dataArr2];

            limpiarContenido();

            proveedores.forEach(element => {
                let total = 0;

                facturas.forEach(factura => {
                    if (factura.razon_social + ' (' + factura.nit + '-' + factura
                        .codigo_verificacion +
                        ')' == element) {
                        let total_factura = factura.valor_total;

                        total_factura = total_factura.split(',');
                        total_factura = total_factura[0];

                        total_factura = parseInt(total_factura.replaceAll('.', ''));
                        total += total_factura;
                    }
                });

                $("#div_proveedores_factura").append(
                    '<div class="d-flex align-items-center item  border-bottom">' +
                    '<div class="d-flex">' +
                    '<img src="{{ asset('images/empleados/noavatar.png') }}" alt="img"' +
                    'class="ht-30 wd-30 me-2">' +
                    '<div class="" style="margin-top: 8px">' +
                    '<h6 class="">' + element + '</h6>' +
                    '</div>' +
                    '</div>' +
                    '<div class="ms-auto my-auto">' +
                    '<div class="d-flex">' +
                    '<span class="me-4 my-auto">' + total.toLocaleString('es-ES', {
                        minimumFractionDigits: 2
                    }) + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
            });

            empleados.forEach(element => {
                let total = 0;

                facturas.forEach(factura => {
                    if (factura.empleado == element) {
                        let total_factura = factura.valor_total;

                        total_factura = total_factura.split(',');
                        total_factura = total_factura[0];

                        total_factura = parseInt(total_factura.replaceAll('.', ''));
                        total += total_factura;
                    }
                });

                $("#div_empleados_factura").append(
                    '<div class="d-flex align-items-center item  border-bottom">' +
                    '<div class="d-flex">' +
                    '<img src="{{ asset('images/empleados/noavatar.png') }}" alt="img"' +
                    'class="ht-30 wd-30 me-2">' +
                    '<div class="" style="margin-top: 8px">' +
                    '<h6 class="">' + element + '</h6>' +
                    '</div>' +
                    '</div>' +
                    '<div class="ms-auto my-auto">' +
                    '<div class="d-flex">' +
                    '<span class="me-4 my-auto">' + total.toLocaleString('es-ES', {
                        minimumFractionDigits: 2
                    }) + '</span>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
            });

            const cargos_array = {};

            impuestos_1.forEach(impuesto => {
                let valor_1 = parseInt(impuesto[1]);
                cargos += valor_1;

                let nombre = impuesto[0];
                let valor = parseInt(impuesto[1]);
                if (cargos_array[nombre]) {
                    cargos_array[nombre] += valor;
                } else {
                    cargos_array[nombre] = valor;
                }
            });

            const retenciones_array = {};

            impuestos_2.forEach(impuesto => {
                let valor_1 = parseInt(impuesto[1]);
                retenciones += valor_1;

                let nombre = impuesto[0];
                let valor = parseInt(impuesto[1]);
                if (retenciones_array[nombre]) {
                    retenciones_array[nombre] += valor;
                } else {
                    retenciones_array[nombre] = valor;
                }
            });

            for (const [key, value] of Object.entries(cargos_array)) {
                $("#tbl_impuesto_cargo").append(
                    '<tr>' +
                    '<td>' + key + '</td>' +
                    '<td>' + value.toLocaleString('es-ES', {
                        minimumFractionDigits: 2
                    }) + '</td>' +
                    '</tr>'
                );
            }

            for (const [key, value] of Object.entries(retenciones_array)) {
                $("#tbl_impuesto_retencion").append(
                    '<tr>' +
                    '<td>' + key + '</td>' +
                    '<td>' + value.toLocaleString('es-ES', {
                        minimumFractionDigits: 2
                    }) + '</td>' +
                    '</tr>'
                );
            }

            $('#totales_facturas').html(totales.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            }));

            $('#cargos_facturas').html(cargos.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            }));

            $('#retenciones_facturas').html(retenciones.toLocaleString('es-ES', {
                minimumFractionDigits: 2
            }));

            // DIVS
            $(".btn_cargos").click(function() {
                if ($("#div_impuestos_cargo").hasClass("d-none")) {
                    $("#div_impuestos_cargo").removeClass("d-none");
                } else {
                    $("#div_impuestos_cargo").addClass("d-none");
                }
            });

            $(".btn_retenciones").click(function() {
                if ($("#div_impuestos_retenciones").hasClass("d-none")) {
                    $("#div_impuestos_retenciones").removeClass("d-none");
                } else {
                    $("#div_impuestos_retenciones").addClass("d-none");
                }
            });

            function limpiarContenido() {
                $("#div_proveedores_factura").html('');
                $("#div_empleados_factura").html('');
                $("#tbl_impuesto_cargo").html('');
                $("#tbl_impuesto_retencion").html('');
            }
        });
    </script>
@endsection
