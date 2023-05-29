@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Solicitudes Inventario</a></li>
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
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Solicitar</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Código</th>
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
                                            <td>{{ date('d-m-Y h:i A', strtotime($solicitud->created_at)) }}</td>
                                            <td>{{ $solicitud->cliente }} ({{ $solicitud->nit }})</td>
                                            <td>{{ $solicitud->descripcion }}</td>
                                            <td>{{ $solicitud->elementos }}</td>
                                            <td>
                                                @if ($solicitud->estado == 1)
                                                    <span class="badge badge-success bg-success">Aceptado</span>
                                                @elseif($solicitud->estado == 2)
                                                    <span class="badge badge-danger bg-danger">Rechazado</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" title="Ver" data-id="{{ $solicitud->id }}"
                                                    class="btn btn-primary btn-sm btnView">
                                                    <i class="fa fa-eye"></i>
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

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Realizar una solicitud de elementos</h6><button aria-label="Close"
                            class="btn-close" data-bs-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-4">
                                <label for="">Motivo</label>
                                <select id="tiposalida_selectadd" class="form-select">
                                    <option value="*">Seleccione una opción</option>
                                    <option value="1">Alquiler</option>
                                    <option value="3">Préstamo</option>
                                    <option value="4">Instalación</option>
                                    <option value="5">Venta</option>
                                    <option value="6">Reparación</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <label for="">Cliente</label>
                                <select class="form-select" id="clienteadd">
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8 d-none">
                                <label for="">Reparación</label>
                                <select class="form-select" id="reparacionadd">
                                    <option value="">Seleccione un cliente</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Descripción de la solicitud</label>
                                <textarea class="form-control" placeholder="Descripción de la solicitud" rows="3" id="descripcionadd"
                                    style="height: 70px; resize: none"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-8">
                                <label for="">Elementos</label>
                                <select class="form-select elementoadd">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($productos as $producto)
                                        <option
                                            value="{{ $producto->nombre }} ({{ $producto->marca }} - {{ $producto->modelo }})">
                                            {{ $producto->nombre }} ({{ $producto->marca }} - {{ $producto->modelo }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="">Cantidades</label>
                                <input class="form-control cantidadadd" placeholder="Cantidad" type="number"
                                    min="1" step="1">
                            </div>
                            <div class="col-1 center-vertical">
                                <a style="margin-top: 30px;" href="javascript:void(0)" id="new_row_elemento">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div id="div_list_elementos"></div>
                        <br>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btn_save_solicitud" type="button">Solicitar</button>
                    </div>
                </div>
            </div>
        </div>

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
                            <div class="col-4">
                                <label for="">Motivo</label>
                                <select id="tiposalida_selectview" disabled class="form-select">
                                    <option value="*">Seleccione una opción</option>
                                    <option value="1">Alquiler</option>
                                    <option value="3">Préstamo</option>
                                    <option value="4">Instalación</option>
                                    <option value="5">Venta</option>
                                    <option value="6">Reparación</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <label for="">Cliente</label>
                                <select class="form-select" id="clienteview" disabled>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8 d-none">
                                <label for="">Reparación</label>
                                <select class="form-select" disabled id="reparacionview">
                                    <option value="">Seleccione un cliente</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Descripción de la solicitud</label>
                                <textarea class="form-control" disabled placeholder="Descripción de la solicitud" rows="3"
                                    id="descripcionview" style="height: 70px; resize: none"></textarea>
                            </div>
                        </div>
                        <br>
                        <div id="div_list_elementos_view"></div>
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
                            <div class="col-4">
                                <label for="">Motivo</label>
                                <select id="tiposalida_selectedit" class="form-select">
                                    <option value="*">Seleccione una opción</option>
                                    <option value="1">Alquiler</option>
                                    <option value="3">Préstamo</option>
                                    <option value="4">Instalación</option>
                                    <option value="5">Venta</option>
                                    <option value="6">Reparación</option>
                                </select>
                            </div>
                            <div class="col-8">
                                <label for="">Cliente</label>
                                <select class="form-select" id="clienteedit">
                                    <option value="">Seleccione un cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }} ({{ $cliente->nit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-8 d-none">
                                <label for="">Reparación</label>
                                <select class="form-select" id="reparacionedit">
                                    <option value="">Seleccione una opción</option>
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
                                <select class="form-select elementoedit">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($productos as $producto)
                                        <option
                                            value="{{ $producto->nombre }} ({{ $producto->marca }} - {{ $producto->modelo }})">
                                            {{ $producto->nombre }} ({{ $producto->marca }} - {{ $producto->modelo }})
                                        </option>
                                    @endforeach
                                </select>
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
    <script>
        $(document).ready(function () {
            let productos = @json($productos);

            localStorage.setItem('productos', JSON.stringify(productos));
        });
    </script>
    <script src="{{ asset('assets/js/app/inventario/solicitud_inventario.js') }}"></script>
@endsection
