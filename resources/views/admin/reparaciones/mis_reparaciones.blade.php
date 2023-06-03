@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Reparaciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Reparaciones Asignadas</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-warning" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Mis Reparaciones Asignadas</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Modelo</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">F. Entrega</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendientes as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->consecutivo }}</td>
                                            <td class="text-center">{{ $value->token }}</td>
                                            <td class="text-center">{{ $value->razon_social }} ({{ $value->nit }})</td>
                                            <td class="text-center">{{ $value->modelo }}</td>
                                            <td class="text-center">{{ $value->serie }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td class="text-center">
                                                <button title="Ver" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-eye"></i> Ver
                                                </button>
                                                @if ($value->aprobado == 0)
                                                    <button title="Avances" class="btn btn-primary btn-sm btnAddAvances"
                                                        data-id="{{ $value->id }}">
                                                        <i class="fa fa-book"></i> Informes
                                                    </button>
                                                    <br>
                                                    <button title="Repuestos"
                                                        class="btn btn-warning btn-sm btnRepuestos mt-1"
                                                        data-id="{{ $value->id }}">
                                                        <i class="fa fa-list"></i> Repuestos
                                                    </button>
                                                    <button title="Completar"
                                                        class="btn btn-success btn-sm btnConfirmar mt-1"
                                                        data-id="{{ $value->id }}">
                                                        <i class="fa fa-check"></i> Completar
                                                    </button>
                                                @endif
                                                <br>
                                                <a href="{{ route('reparacion_pdf') }}?token={{ $value->id }}"
                                                    target="_BLANK" title="Imprimir" class="btn btn-primary btn-sm mt-1">
                                                    <i class="fa fa-print"></i> Imprimir
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex-header-table bg-success" style="border-radius: 4px">
                        <div class="div-1-tables-header">
                            <h3 class="card-title mt-2">Mis Reparaciones Completadas</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Código</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Modelo</th>
                                        <th class="text-center">Serie</th>
                                        <th class="text-center">F. Entrega</th>
                                        <th class="text-center">F. Terminado</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($finalizadas as $value)
                                        <tr>
                                            <td class="text-center">{{ $value->consecutivo }}</td>
                                            <td class="text-center">{{ $value->token }}</td>
                                            <td class="text-center">{{ $value->razon_social }} ({{ $value->nit }})</td>
                                            <td class="text-center">{{ $value->modelo }}</td>
                                            <td class="text-center">{{ $value->serie }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($value->fecha_terminado)) }}
                                            </td>
                                            <td class="text-center">
                                                <button title="Ver" class="btn btn-primary btn-sm btnView"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-eye"></i> Ver
                                                </button>
                                                <button title="Avances" class="btn btn-warning btn-sm btnVerAvances"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-pencil-alt"></i> Avances
                                                </button>
                                                <br>
                                                <button title="Imprimir" class="btn btn-success btn-sm btnImprimir mt-1"
                                                    data-id="{{ $value->id }}">
                                                    <i class="fa fa-print"></i> Imprimir
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->

        <!-- Modal View -->
        <div class="modal  fade" id="modalView">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Ver recepción</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente</label>
                                <select id="cliente_view" disabled class="form-select">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}
                                            ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="">Ingrese los correos separados por (,) para enviar el certificado de
                                    recepción</label>
                                <input class="form-control" disabled id="correos_view"
                                    placeholder="Correos electrónicos para enviar informe separados por coma (,)"
                                    type="text">
                            </div>
                        </div>
                        <br>
                        <div id="div_reparaciones_view"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Repuesto -->
        <div class="modal  fade" id="modalRepuesto">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Repuestos Reparación</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <br>
                        <div class="table-responsive">
                            <table id="reparaciones_tbl"
                                class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">Repuesto</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Informe -->
        <div class="modal  fade" id="modalAvances">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Informes Reparación</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="id_reparacion_avance">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Informe</label>
                                <textarea class="form-control" placeholder="Informe" rows="3" id="observaciones_avance"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Anexo (Opcional)</label>
                                <input class="form-control" id="anexo_avance_add" type="file">
                            </div>
                        </div>
                        <br>
                        <div style="display: flex; justify-content: center">
                            <button class="btn ripple btn-primary" id="btnGuardarAvance" type="button">Agregar
                                Informe</button>
                        </div>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table id="avances_tbl"
                                class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="text-center">Informe</th>
                                        <th class="text-center">Técnico</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Anexo</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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
            let encargados = @json($empleados);
            let categorias = @json($categorias);
            let accesorios = @json($accesorios);

            localStorage.setItem('encargados', JSON.stringify(encargados));
            localStorage.setItem('categorias', JSON.stringify(categorias));
            localStorage.setItem('accesorios', JSON.stringify(accesorios));
        });
    </script>
    <script src="{{ asset('assets/js/app/reparaciones/mis_reparaciones.js') }}"></script>
@endsection
