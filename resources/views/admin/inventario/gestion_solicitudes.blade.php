@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Gestionar Solicitudes Inventario</a></li>
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
                            <h3 class="card-title mt-2">Solicitudes Pendientes</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Empleado</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Cliente</th>
                                        <th>Descripción</th>
                                        <th>Elementos</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendientes as $solicitud)
                                        <tr>
                                            <td>{{ $solicitud->codigo }}</td>
                                            <td>{{ $solicitud->empleado }}</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($solicitud->created_at)) }}</td>
                                            <td>{{ $solicitud->cliente }} ({{ $solicitud->nit }})</td>
                                            <td>{{ $solicitud->descripcion }}</td>
                                            <td>{{ $solicitud->elementos }}</td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" title="Ver" data-id="{{ $solicitud->id }}"
                                                    class="btn btn-primary btn-sm btnView">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0)" title="Editar" data-id="{{ $solicitud->id }}"
                                                    class="btn btn-primary btn-sm btnEditar">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <a href="javascript:void(0)" title="Aceptar" data-id="{{ $solicitud->id }}"
                                                    class="btn btn-success btn-sm btnAceptar">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                                <a href="javascript:void(0)" title="Rechazar" data-id="{{ $solicitud->id }}"
                                                    class="btn btn-warning btn-sm btnRechazar">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                <a href="javascript:void(0)" title="Eliminar"
                                                    data-id="{{ $solicitud->id }}"
                                                    class="btn btn-danger btn-sm btnEliminar">
                                                    <i class="fa fa-trash"></i>
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
                            <h3 class="card-title mt-2">Solicitudes Gestionadas</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Empleado</th>
                                        <th>Fecha Solicitud</th>
                                        <th>Cliente</th>
                                        <th>Descripción</th>
                                        <th>Elementos</th>
                                        <th>Estatus</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gestionados as $solicitud)
                                        <tr>
                                            <td>{{ $solicitud->codigo }}</td>
                                            <td>{{ $solicitud->empleado }}</td>
                                            <td>{{ date('d-m-Y h:i A', strtotime($solicitud->created_at)) }}</td>
                                            <td>{{ $solicitud->cliente }} ({{ $solicitud->nit }})</td>
                                            <td>{{ $solicitud->descripcion }}</td>
                                            <td>{{ $solicitud->elementos }}</td>
                                            <td>
                                                @if ($solicitud->estado == 1)
                                                    <span class="badge bg-success side-badge bg-success">Aceptado</span>
                                                @elseif($solicitud->estado == 2)
                                                    <span class="badge bg-danger side-badge bg-danger">Rechazado</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" title="Ver" data-id="{{ $solicitud->id }}"
                                                    class="btn btn-primary btn-sm btnView">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0)" title="Eliminar"
                                                    data-id="{{ $solicitud->id }}"
                                                    class="btn btn-danger btn-sm btnEliminar">
                                                    <i class="fa fa-trash"></i>
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

        <!-- Modal View -->
        <div class="modal  fade" id="modalView">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Solicitud de elementos</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente</label>
                                <select class="form-select" id="clienteview" disabled>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} ({{ $cliente->nit }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Descripción de la solicitud</label>
                                <textarea class="form-control" disabled placeholder="Descripción de la solicitud" rows="3" id="descripcionview"
                                    style="height: 70px; resize: none"></textarea>
                            </div>
                        </div>
                        <br>
                        <div id="div_list_elementos_view"></div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Asignar -->
        <div class="modal  fade" id="modalAsignar">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Asignar elemento</h6><button aria-label="Close" class="btn-close"
                            id="btnCloseAsignar" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled id="id_solicitud_gestion">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Elemento</label>
                                <select class="form-select" id="elementogestion">
                                    <option value="">Seleccione un elemento</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }} ({{ $producto->marca }} - {{ $producto->modelo }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cantidad</label>
                                <input type="number" class="form-control" min="1" step="1" id="cantidadgestion" placeholder="Cantidad">
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Solicitud de elementos</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" disabled readonly id="solicitudid">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cliente</label>
                                <select class="form-select" id="clienteedit">
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} ({{ $cliente->nit }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Descripción de la solicitud</label>
                                <textarea class="form-control" placeholder="Descripción de la solicitud" rows="3" id="descripcionedit"
                                    style="height: 70px; resize: none"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-8">
                                <label for="">Elementos</label>
                                <input class="form-control elementoedit" placeholder="Elemento" type="text">
                            </div>
                            <div class="col-3">
                                <label for="">Cantidades</label>
                                <input class="form-control cantidadedit" placeholder="Cantidad" type="number"
                                    min="1" step="1">
                            </div>
                            <div class="col-1 center-vertical">
                                <a style="margin-top: 30px;" href="javascript:void(0)" id="new_row_elemento_edit">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div id="div_list_elementos_edit"></div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btn_update_solicitud"
                            type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/inventario/solicitud_inventario.js') }}"></script>
@endsection
