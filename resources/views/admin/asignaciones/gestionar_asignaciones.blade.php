@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">

        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Asignaciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Gestionar Asignaciones</li>
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
                            <h3 class="card-title mt-2">Lista de Asignaciones Pendientes</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Crear Asignación</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">Código</th>
                                        <th class="wd-20p border-bottom-0">Empleado</th>
                                        <th class="wd-20p border-bottom-0">Descripción</th>
                                        <th class="wd-20p border-bottom-0">Asignación</th>
                                        <th class="wd-10p border-bottom-0">Fecha Inicio</th>
                                        <th class="wd-10p border-bottom-0">Fecha<br>Culminación<br>Tentativa</th>
                                        <th class="wd-10p border-bottom-0">Estado</th>
                                        <th class="wd-15p border-bottom-0">Creada por</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                        <th class="wd-15p border-bottom-0">Visto<br>Bueno</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($asignaciones_pendientes as $value)
                                        <tr>
                                            <td>{{ $value->codigo }}</td>
                                            <td>{{ $value->nombre }}</td>
                                            <td>{{ $value->descripcion }}</td>
                                            <td>{{ $value->asignacion }}</td>
                                            <td>{{ date('d-m-Y g:i A', strtotime($value->fecha)) }}</td>
                                            <td>{{ date('d-m-Y g:i A', strtotime($value->fecha_culminacion)) }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td>{{ $value->creador }}</td>
                                            <td>
                                                <a class="d-flex btn_completar" data-id="{{ $value->id }}" href="#"><i class="fa fa-check"></i>&nbsp;Completar</a>
                                                <a class="d-flex btn_editar_pend" data-id="{{ $value->id }}" href="#"><i class="fa fa-pencil-alt"></i>&nbsp;Editar</a>
                                                <a class="d-flex btn_avances" data-id="{{ $value->id }}" href="#"><i class="fa fa-file"></i>&nbsp;Ver Avances</a>
                                                <a class="d-flex btn_rechazar" data-id="{{ $value->id }}" href="#"><i class="fa fa-times"></i>&nbsp;Rechazar</a>
                                                <a class="d-flex btn_eliminar" data-id="{{ $value->id }}" href="#"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
                                            </td>
                                            <td class="text-center">
                                                <input @if($value->visto_bueno == 1) { @checked(true) } @endif type="checkbox">
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
                    <div class="card-header bg-success" style="border-radius: 4px">
                        <h3 class="card-title mt-2">Lista de Asignaciones Completadas</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">Código</th>
                                        <th class="wd-20p border-bottom-0">Empleado</th>
                                        <th class="wd-20p border-bottom-0">Descripción</th>
                                        <th class="wd-20p border-bottom-0">Asignación</th>
                                        <th class="wd-10p border-bottom-0">Fecha Inicio</th>
                                        <th class="wd-10p border-bottom-0">Fecha<br>Culminación<br>Tentativa</th>
                                        <th class="wd-10p border-bottom-0">Estado</th>
                                        <th class="wd-15p border-bottom-0">Creada por</th>
                                        <th class="wd-15p border-bottom-0">Acciones</th>
                                        <th class="wd-15p border-bottom-0">Visto<br>Bueno</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($asignaciones_completadas as $value)
                                        <tr>
                                            <td>{{ $value->codigo }}</td>
                                            <td>{{ $value->nombre }}</td>
                                            <td>{{ $value->descripcion }}</td>
                                            <td>{{ $value->asignacion }}</td>
                                            <td>{{ date('d-m-Y g:i A', strtotime($value->fecha)) }}</td>
                                            <td>{{ date('d-m-Y g:i A', strtotime($value->fecha_culminacion)) }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td>{{ $value->creador }}</td>
                                            <td>
                                                <a class="d-flex btn_avances" data-id="{{ $value->id }}" href="#"><i class="fa fa-file"></i>&nbsp;Ver Avances</a>
                                                <a class="d-flex btn_rechazar" data-id="{{ $value->id }}" href="#"><i class="fa fa-times"></i>&nbsp;Rechazar</a>
                                                <a class="d-flex btn_eliminar" data-id="{{ $value->id }}" href="#"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
                                            </td>
                                            <td class="text-center">
                                                <input @if($value->visto_bueno == 1) { @checked(true) } @endif type="checkbox">
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
    </div>

    <!-- Modal Add -->
    <div class="modal  fade" id="modalAdd">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Crear una asignación</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg center-vertical">
                            <select class="form-select empleadoadd">
                                <option value="">Seleccione un empleado</option>
                                @foreach ($empleados as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0" style="display: flex">
                            <textarea class="form-control observacionesadd" placeholder="Asignación individual de este empleado" rows="2"
                                style="height: 50px; resize: none"></textarea>
                            <a class="center-vertical mg-s-10" href="#" id="new_row_empleado"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div id="div_new_empleados"></div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Descripción de la asignación</label>
                            <textarea class="form-control" placeholder="Descripción de la asignación" rows="3" id="observacion_generaladd"
                                style="height: 90px; resize: none"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Anexos de la asignación (Opcional)</label>
                            <input class="form-control" id="anexosadd" multiple type="file"
                                accept="image/png, image/jpeg">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Fecha y Hora de inicio</label>
                            <input class="form-control" id="fecha_inicioadd" type="datetime-local">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Fecha y Hora de tentativa de culminación</label>
                            <input class="form-control" id="fecha_finadd" type="datetime-local">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" id="btnGuardarAsignacion" type="button">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/gestionar_asignaciones.js') }}"></script>
@endsection
