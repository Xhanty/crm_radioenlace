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
                        <li class="breadcrumb-item active" aria-current="page"> Mis Asignaciones</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- row -->
        <div class="row row-sm">
            <div class="col-xl-9 col-md-12">
                <div class="row row-sm" id="div_asignaciones_pendientes">

                    @foreach ($asignaciones_pendientes as $value)
                        <!-- col -->
                        <div class="col-xl-4 col-md-6">
                            <div class="card mg-b-20">
                                <div class="card-body p-0">
                                    <div class="todo-widget-header d-flex pb-2 pd-20 bg-warning"
                                        style="border-radius: 4px;">
                                        <div class="ms-auto">
                                            <div class="" style="cursor: pointer;">
                                                <a class="p-2 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v" style="color: #fff"></i></a>
                                                <div class="dropdown-menu tx-13 dropleft">
                                                    <a class="dropdown-item btn_openAvances"
                                                        data-asignacion="{{ $value->asignacion }}"
                                                        data-idshow="{{ $value->id }}" href="javascript:void(0);">Agregar
                                                        Avance</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <span class="tx-12 text-muted">Descripción</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->descripcion }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Asignada por</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->nombre }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Mi Asignación</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->asignacion }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Fecha Inicio</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->fecha }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Fecha Culminación Tentativa</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->fecha_culminacion }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Fecha Culminación</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->fecha_completada }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /col -->
                    @endforeach
                </div>

                <div class="row row-sm d-none" id="div_asignaciones_completadas">

                    @foreach ($asignaciones_completadas as $value)
                        <!-- col -->
                        <div class="col-xl-4 col-md-6">
                            <div class="card mg-b-20">
                                <div class="card-body p-0">
                                    <div class="todo-widget-header d-flex pb-2 pd-20 bg-success"
                                        style="border-radius: 4px;">
                                        <div class="ms-auto">
                                            <div class="" style="cursor: pointer;">
                                                <a class="p-2 text-muted" data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="fas fa-ellipsis-v" style="color: #fff"></i></a>
                                                <div class="dropdown-menu tx-13 dropleft">
                                                    <a class="dropdown-item btn_viewAvances"
                                                        data-id="{{ $value->id }}" href="javascript:void(0);">Ver
                                                        Avances</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <span class="tx-12 text-muted">Descripción</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->descripcion }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Asignada por</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->nombre }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Mi Asignación</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->asignacion }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Fecha Inicio</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->fecha }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Fecha Culminación Tentativa</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->fecha_culminacion }}</h5>
                                    </div>
                                    <div class="p-3 border-top">
                                        <span class="tx-12 text-muted">Fecha Culminación</span>
                                        <h5 class="tx-14 mb-0 mg-t-5 text-capitalize">{{ $value->fecha_completada }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /col -->
                    @endforeach
                </div>
            </div>
            <!-- /col -->

            <!-- col -->
            <div class="col-lg-12 col-xl-3">
                <div class="card card--events mg-b-20">
                    <div class="card-body">
                        <div class="pd-20">
                            <div class="main-content-label">Asignaciones</div>
                            <p class="mg-b-0">Listado de las asignaciones (Por defecto se muestran las pendientes).</p>
                        </div>
                        <div class="list-group to-do-tasks ">
                            <a class="list-group-item" id="show_pendientes" href="javascript:void(0);">
                                <div class="event-indicator bg-warning"></div>
                                <h6 class="mg-t-5">Pendientes</h6>
                            </a>
                            <a class="list-group-item" id="show_completadas" href="javascript:void(0);">
                                <div class="event-indicator bg-success"></div>
                                <h6 class="mg-t-5">Completadas</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Registro de Avances</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="asignacion_id_add" disabled readonly>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Descripción</label>
                                <textarea id="descripcion_add" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Estatus</label>
                                <select id="status_add" class="form-select">
                                    <option value="1">En Progreso</option>
                                    <option value="0">Asignado</option>
                                    <option value="2">Completado</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="">Anexo del avance (Opcional)</label>
                                <input type="file" id="archivo_add" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <button class="btn ripple btn-primary" id="btnGuardarAvance" type="button">Agregar
                                Avance</button>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="tbl_avances">
                                <thead>
                                    <tr>
                                        <th class="wd-10p border-bottom-0">Fecha</th>
                                        <th class="wd-15p border-bottom-0">Archivo</th>
                                        <th class="wd-40p border-bottom-0">Descripción</th>
                                        <th class="wd-10p border-bottom-0">Status</th>
                                        <th class="wd-10p border-bottom-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
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
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#show_pendientes').click(function() {
                $('#div_asignaciones_pendientes').removeClass('d-none');
                $('#div_asignaciones_completadas').addClass('d-none');
            });

            $('#show_completadas').click(function() {
                $('#div_asignaciones_pendientes').addClass('d-none');
                $('#div_asignaciones_completadas').removeClass('d-none');
            });
        });
    </script>
    <script src="{{ asset('assets/js/app/asignaciones/mis_asignaciones.js') }}"></script>
@endsection
