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
                                                    <a class="dropdown-item" data-id="{{ $value->id }}"
                                                        href="javascript:void(0);">Agregar Avance</a>
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
                                            <div class="" style="cursor: pointer; height: 20px"></div>
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

@endsection
