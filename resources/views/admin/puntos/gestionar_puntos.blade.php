@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Puntos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Gestionar Puntos</li>
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
                            <h3 class="card-title mt-2">Puntos Pendientes</h3>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Rango de fecha</label>
                                    <input class="form-control" id="rangofilter1" readonly placeholder="Fechas">
                                </div>
                                <div class="col-lg">
                                    <label for="">Empleado</label>
                                    <select id="empleadofilter1" class="form-select select2">
                                        <option value="">Todos</option>
                                        @foreach ($empleados as $value)
                                            <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Asignar Puntos</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t" id="tbl_pendientes">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Fecha</th>
                                        <th class="wd-15p border-bottom-0">Trabajador</th>
                                        <th class="wd-30p border-bottom-0">Descripción</th>
                                        <th class="wd-10p border-bottom-0">Tipo</th>
                                        <th class="wd-10p border-bottom-0">Cantidad</th>
                                        <th class="wd-10p border-bottom-0">Asignados Por</th>
                                        <th class="wd-10p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($puntos_pendientes as $value)
                                        <tr>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->fecha)) }}</td>
                                            <td>{{ $value->nombre_empleado }}</td>
                                            <td>{{ $value->descripcion }}</td>
                                            <td>
                                                @if ($value->tipo == 0)
                                                    <span class="badge bg-success">Fijos</span>
                                                @elseif($value->tipo == 1)
                                                    <span class="badge bg-warning">Ocasionales</span>
                                                @else
                                                    <span class="badge bg-danger">Negativos</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($value->tipo == 0 || $value->tipo == 1)
                                                    <span class="text-success">{{ $value->cantidad }}</span>
                                                @else
                                                    <span class="text-danger">{{ $value->cantidad }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $value->nombre_creador }}</td>
                                            <td>
                                                <a class="d-flex btn_editar" data-id="{{ $value->id }}"
                                                    data-fecha="{{ $value->fecha }}"
                                                    data-empleado="{{ $value->id_empleado }}"
                                                    data-descripcion="{{ $value->descripcion }}"
                                                    data-tipo="{{ $value->tipo }}" data-puntos="{{ $value->cantidad }}"
                                                    href="javascript:void(0);"><i
                                                        class="fa fa-pencil-alt"></i>&nbsp;Editar</a>
                                                <a class="d-flex btn_eliminar" data-id="{{ $value->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
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
                            <h3 class="card-title mt-2">Puntos Cobrados</h3>
                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="">Rango de fecha</label>
                                    <input class="form-control" id="rangofilter2" placeholder="Fechas" readonly>
                                </div>
                                <div class="col-lg">
                                    <label for="">Empleado</label>
                                    <select id="empleadofilter2" class="form-select">
                                        <option value="">Todos</option>
                                        @foreach ($empleados as $value)
                                            <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="btnRealizarCorte">Realizar Corte</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t" id="tbl_completados">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">Fecha</th>
                                        <th class="wd-15p border-bottom-0">Trabajador</th>
                                        <th class="wd-30p border-bottom-0">Descripción</th>
                                        <th class="wd-10p border-bottom-0">Tipo</th>
                                        <th class="wd-10p border-bottom-0">Cantidad</th>
                                        <th class="wd-10p border-bottom-0">Asignados Por</th>
                                        <th class="wd-10p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($puntos_cobrados as $value)
                                        <tr>
                                            <td>{{ date('d-m-Y H:i A', strtotime($value->fecha)) }}</td>
                                            <td>{{ $value->nombre_empleado }}</td>
                                            <td>{{ $value->descripcion }}</td>
                                            <td>
                                                @if ($value->tipo == 0)
                                                    <span class="badge bg-success">Fijos</span>
                                                @elseif($value->tipo == 1)
                                                    <span class="badge bg-warning">Ocasionales</span>
                                                @else
                                                    <span class="badge bg-danger">Negativos</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($value->tipo == 0 || $value->tipo == 1)
                                                    <span class="text-success">{{ $value->cantidad }}</span>
                                                @else
                                                    <span class="text-danger">{{ $value->cantidad }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $value->nombre_creador }}</td>
                                            <td>
                                                <a class="d-flex btn_editar" data-id="{{ $value->id }}"
                                                    data-fecha="{{ $value->fecha }}"
                                                    data-empleado="{{ $value->id_empleado }}"
                                                    data-descripcion="{{ $value->descripcion }}"
                                                    data-tipo="{{ $value->tipo }}" data-puntos="{{ $value->cantidad }}"
                                                    href="javascript:void(0);"><i
                                                        class="fa fa-pencil-alt"></i>&nbsp;Editar</a>
                                                <a class="d-flex btn_eliminar" data-id="{{ $value->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
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
                        <h6 class="modal-title">Asignar Puntos</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Empleado</label>
                                <select id="empleadoadd" class="form-select">
                                    @foreach ($empleados as $value)
                                        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Fecha</label>
                                <input class="form-control" id="fechaadd" placeholder="Fecha" type="datetime-local">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cantidad Puntos</label>
                                <input class="form-control" id="puntosadd" placeholder="Cantidad Puntos" type="number">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Tipo de puntos</label>
                                <select id="tipopuntosadd" class="form-select">
                                    <option value="1">Puntos Ocasionales</option>
                                    <option value="0">Puntos Fijos</option>
                                    <option value="2">Puntos Negativos</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Observaciones</label>
                                <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacionesadd"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarPuntos" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Puntos</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idpuntosedit" readonly disabled>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Empleado</label>
                                <select id="empleadoedit" class="form-select">
                                    @foreach ($empleados as $value)
                                        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Fecha</label>
                                <input class="form-control" id="fechaedit" placeholder="Fecha" type="datetime-local">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Cantidad Puntos</label>
                                <input class="form-control" id="puntosedit" placeholder="Cantidad Puntos"
                                    type="number">
                            </div>
                            <div class="col-lg mg-t-10 mg-lg-t-0">
                                <label for="">Tipo de puntos</label>
                                <select id="tipopuntosedit" class="form-select">
                                    <option value="1">Puntos Ocasionales</option>
                                    <option value="0">Puntos Fijos</option>
                                    <option value="2">Puntos Negativos</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Observaciones</label>
                                <textarea class="form-control" placeholder="Observaciones" rows="3" id="observacionesedit"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnModificarPuntos" type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/gestionar_puntos.js') }}"></script>
@endsection
