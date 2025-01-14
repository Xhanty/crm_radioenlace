@extends('layouts.menu')

@section('content')
    <style>
        .cards tbody tr {
            float: right;
            width: 32%;
            margin: 0.5rem;
            border: 0.0625rem solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            box-shadow: 0.25rem 0.25rem 0.5rem rgba(0, 0, 0, 0.25);
        }

        @media (max-width: 768px) {
            .cards tbody tr {
                width: 100%;
            }
        }

        @media (max-width: 1526px) {
            .cards tbody tr {
                width: 44%;
            }
        }

        .card {
            border: none;
        }

        .cards tbody td {
            display: block;
            border: none;
            text-align: right;
        }

        .cards thead {
            display: none;
        }

        .cards td:before {
            content: attr(data-label);
            position: relative;
            color: #808080;
            min-width: 4rem;
            text-align: right;
        }

        tr.selected td:before {
            color: #ccc;
        }

        .dt-buttons {
            display: none !important;
        }

        .number-section {
            margin: 1rem 0;
        }
    </style>

    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Asignaciones</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                        <li class="breadcrumb-item active" aria-current="page">Gestionar Asignaciones</li>
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
                            @if (auth()->user()->hasPermissionTo('gestion_asignacion'))
                                <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                    data-bs-effect="effect-scale">Crear Asignación</button>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_asignaciones_pendientes"
                                class="table border-top-0 table-bordered text-nowrap border-bottom cards basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignaciones_pendientes as $value)
                                        <tr>
                                            <td>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="separator mx-3"></div>
                                                        <div class="d-flex flex-row justify-content-between px-3">
                                                            <span class="text-muted">Código</span>
                                                            <h6>{{ $value->codigo }}</h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <span class="text-muted">Empleado</span>
                                                            <h6 class="mb-0">{{ $value->nombre }}</h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <span class="text-muted">Cliente</span>
                                                            <h6 class="mb-0">{{ $value->cliente }}</h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <span class="text-muted">Asignación</span>
                                                            <h6 class="mb-0">
                                                                {{ strlen($value->asignacion) > 44 ? substr($value->asignacion, 0, 44) . '...' : $value->asignacion }}
                                                            </h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <span class="text-muted">Fechas</span>
                                                            <h6 class="mb-0">
                                                                {{ date('d-m-Y', strtotime($value->fecha)) }} /
                                                                {{ date('d-m-Y', strtotime($value->fecha_culminacion)) }}
                                                            </h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="text-center"
                                                            style="display: grid; justify-content: center">
                                                            @if (auth()->user()->hasPermissionTo('gestion_asignacion'))
                                                                @if ($value->revision == 1)
                                                                    <a class="d-flex btn_completar"
                                                                        data-id="{{ $value->id }}"
                                                                        href="javascript:void(0);"><i
                                                                            class="fa fa-check"></i>&nbsp;Completar</a>
                                                                    <a class="d-flex btn_rechazar"
                                                                        data-id="{{ $value->id }}"
                                                                        href="javascript:void(0);"><i
                                                                            class="fa fa-times"></i>&nbsp;Rechazar</a>
                                                                @endif
                                                                <a class="d-flex btn_openDetalles"
                                                                    data-id="{{ $value->id }}"
                                                                    href="javascript:void(0);"><i
                                                                        class="fa fa-eye"></i>&nbsp;Ver</a>
                                                                <a class="d-flex btn_editar" data-id="{{ $value->id }}"
                                                                    href="javascript:void(0);"><i
                                                                        class="fa fa-pencil-alt"></i>&nbsp;Editar</a>
                                                                <a class="d-flex btn_avances" data-id="{{ $value->id }}"
                                                                    href="javascript:void(0);"><i
                                                                        class="fa fa-file"></i>&nbsp;Ver
                                                                    Avances</a>
                                                                <a class="d-flex btn_eliminar"
                                                                    data-id="{{ $value->id }}"
                                                                    href="javascript:void(0);"><i
                                                                        class="fa fa-trash"></i>&nbsp;Eliminar</a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
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
                            <h3 class="card-title mt-2">Lista de Asignaciones Completadas</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <!-- Excel -->
                            <a href="{{ route('asignaciones_clientes_excel') }}" class="btn btn-primary">Generar
                                Excel</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_asignaciones_completadas"
                                class="table border-top-0 table-bordered text-nowrap border-bottom cards basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignaciones_completadas as $value)
                                        <tr>
                                            <td>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="separator mx-3"></div>
                                                        <div class="d-flex flex-row justify-content-between px-3">
                                                            <span class="text-muted">Código</span>
                                                            <h6>{{ $value->codigo }}</h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <span class="text-muted">Empleado</span>
                                                            <h6 class="mb-0">{{ $value->nombre }}</h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <span class="text-muted">Cliente</span>
                                                            <h6 class="mb-0">{{ $value->cliente }}</h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <span class="text-muted">Asignación</span>
                                                            <h6 class="mb-0">
                                                                {{ strlen($value->asignacion) > 44 ? substr($value->asignacion, 0, 44) . '...' : $value->asignacion }}
                                                            </h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="d-flex flex-row justify-content-between px-3 pb-1">
                                                            <span class="text-muted">Fechas</span>
                                                            <h6 class="mb-0">
                                                                {{ date('d-m-Y', strtotime($value->fecha_culminacion)) }} /
                                                                {{ date('d-m-Y', strtotime($value->fecha)) }}
                                                            </h6>
                                                        </div>
                                                        <hr class=" mx-3">
                                                        <div class="text-center"
                                                            style="display: grid; justify-content: center">
                                                            @if (auth()->user()->hasPermissionTo('gestion_asignacion'))
                                                            <a class="d-flex btn_openDetalles"
                                                                data-id="{{ $value->id }}"
                                                                href="javascript:void(0);"><i
                                                                    class="fa fa-eye"></i>&nbsp;Ver</a>
                                                            <a class="d-flex btn_avances" data-id="{{ $value->id }}"
                                                                href="javascript:void(0);"><i
                                                                    class="fa fa-file"></i>&nbsp;Ver
                                                                Avances</a>
                                                            @if ($value->revision == 2)
                                                                <a class="d-flex btn_rechazar"
                                                                    data-id="{{ $value->id }}"
                                                                    href="javascript:void(0);"><i
                                                                        class="fa fa-times"></i>&nbsp;Rechazar</a>
                                                            @endif
                                                            <a class="d-flex btn_eliminar" data-id="{{ $value->id }}"
                                                                href="javascript:void(0);"><i
                                                                    class="fa fa-trash"></i>&nbsp;Eliminar</a>
                                                                    @endif
                                                        </div>
                                                    </div>
                                                </div>
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Crear una asignación</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Cliente</label>
                            <select class="form-select" id="cliente_add">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <label for="" style="margin-bottom: -3px">Empleados</label>
                        <div class="col-lg center-vertical">
                            <select class="form-select empleadoadd">
                                @foreach ($empleados as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0" style="display: flex">
                            <textarea class="form-control observacionesadd" placeholder="Asignación individual de este empleado" rows="4"
                                style="height: 100px; resize: none"></textarea>
                            <a class="center-vertical mg-s-10" href="javascript:void(0);" id="new_row_empleado"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div id="div_new_empleados"></div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Descripción de la asignación</label>
                            <textarea class="form-control" placeholder="Descripción de la asignación" rows="6" id="observacion_generaladd"
                                style="height: 180px; resize: none"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Anexos de la asignación (Opcional)</label>
                            <input class="form-control" id="anexosadd" multiple type="file">
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

    <!-- Modal Edit -->
    <div class="modal  fade" id="modalEdit">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Modificar la asignación</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idasignacionedit" disabled readonly>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Cliente</label>
                            <select class="form-select" id="cliente_edit">
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <label for="" style="margin-bottom: -3px">Empleados</label>
                        <div class="col-4 center-vertical">
                            <select class="form-select" id="empleadoedit">
                                @foreach ($empleados as $value)
                                    <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-8 mg-t-10 mg-lg-t-0" style="display: flex">
                            <textarea class="form-control" placeholder="Asignación individual de este empleado" rows="5"
                                style="height: 120px; resize: none" id="observacionesedit"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Descripción de la asignación</label>
                            <textarea class="form-control" placeholder="Descripción de la asignación" rows="6"
                                id="observacion_generaledit" style="height: 180px; resize: none"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Anexos de la asignación (Opcional)</label>
                            <input class="form-control" id="anexosedit" multiple type="file">
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Fecha y Hora de inicio</label>
                            <input class="form-control" id="fecha_inicioedit" type="datetime-local">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Fecha y Hora de tentativa de culminación</label>
                            <input class="form-control" id="fecha_finedit" type="datetime-local">
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                            id="tbl_anexos_asignacion">
                            <thead>
                                <tr>
                                    <th class="wd-40p border-bottom-0">Anexo</th>
                                    <th class="wd-20p border-bottom-0">Acciones</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" id="btnEditarAsignacion" type="button">Modificar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal View Avances -->
    <div class="modal  fade" id="modalView">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Listado de Avances</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="tbl_view_avances">
                            <thead>
                                <tr>
                                    <th class="wd-10p border-bottom-0">Fecha</th>
                                    <th class="wd-15p border-bottom-0">Archivo</th>
                                    <th class="wd-40p border-bottom-0">Descripción</th>
                                    <th class="wd-10p border-bottom-0">Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Show Asignación -->
    <div class="modal  fade" id="modalDetalles">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Detalles de la asignación</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Asignación</label>
                            <input type="text" class="form-control" placeholder="Asignación" disabled
                                id="asignacion_show">
                        </div>
                        <div class="col-lg">
                            <label for="">Cliente</label>
                            <select class="form-select" id="cliente_show" disabled>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Descripción de la asignación</label>
                            <textarea class="form-control" placeholder="Descripción de la asignación" disabled rows="6"
                                id="observacion_show" style="height: 180px; resize: none"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label for="">Fecha y Hora de inicio</label>
                            <input class="form-control" id="fecha_inicio_show" disabled type="datetime-local">
                        </div>
                        <div class="col-lg mg-t-10 mg-lg-t-0">
                            <label for="">Fecha y Hora de tentativa de culminación</label>
                            <input class="form-control" id="fecha_fin_show" disabled type="datetime-local">
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table border-top-0 table-bordered text-nowrap border-bottom"
                            id="tbl_anexos_asignacion_show">
                            <thead>
                                <tr>
                                    <th class="wd-40p border-bottom-0">Anexos</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        setTimeout(() => {
            // Obtener la URL de la página actual
            var url = new URL(window.location.href);

            // Obtener el valor del parámetro 'pr'
            var prParam = url.searchParams.get("asignacion");

            // Validar si 'pr' está presente
            if (prParam !== null) {
                console.log("El parámetro 'pr' está presente con el valor: " + prParam);
                $("#table_asignaciones_pendientes_wrapper input").val(prParam).trigger("keyup");
                $("#table_asignaciones_completadas_wrapper input").val(prParam).trigger("keyup");
            } else {
                console.log("El parámetro 'pr' no está presente en la URL.");
            }
        }, 2000);
    </script>
    <script src="{{ asset('assets/js/app/asignaciones_clientes/gestionar_asignaciones.js') }}"></script>
@endsection
