@extends('layouts.menu')

@section('content')
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">CRM | Radio Enlace</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Proyectos</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Proyectos</li>
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
                            <h3 class="card-title mt-2">Lista de Proyectos Pendientes</h3>
                        </div>
                        <div class="div-2-tables-header">
                            <button class="btn btn-primary" id="btnNewProveedor">Crear Proyecto</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Asignado por</th>
                                        <th>Categoría</th>
                                        <th>Nombre Proyecto</th>
                                        <th>Cliente</th>
                                        <th>Puntos</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Culminación</th>
                                        <th>¿Trjs. Culm.?</th>
                                        <th>Acciones</th>
                                        <th>Visto<br>Bueno</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyectos_pendientes as $proyecto)
                                        <tr>
                                            <td>{{ $proyecto->empleado }}</td>
                                            <td>{{ $proyecto->categoria }}</td>
                                            <td>{{ $proyecto->nombre }}</td>
                                            <td>{{ $proyecto->cliente }}</td>
                                            <td>{{ $proyecto->puntos }}</td>
                                            <td>{{ $proyecto->fecha_inicio }}</td>
                                            <td>{{ $proyecto->fecha_culminacion }}</td>
                                            <td>{{ $proyecto->fecha_culminacion }}</td>
                                            <td>
                                                <a class="d-flex btn_completar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-list"></i>&nbsp;Gestionar
                                                    Estatus</a>
                                                <a class="d-flex btn_board" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-check"></i>&nbsp;Asignaciones</a>
                                                <a class="d-flex btn_avances" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i
                                                        class="fa fa-pencil-alt"></i>&nbsp;Editar</a>
                                                <a class="d-flex btn_avances" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-file"></i>&nbsp;Gestionar
                                                    Acta</a>
                                                <a class="d-flex btn_eliminar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
                                                <a class="d-flex btn_avances" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-user"></i>&nbsp;Firma
                                                    Cliente</a>
                                            </td>
                                            <td class="text-center">
                                                <input data-id="{{ $proyecto->id }}" class="visto_bueno_check"
                                                    @if ($proyecto->visto_bueno == 1) { checked } @endif type="checkbox">
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
                            <h3 class="card-title mt-2">Lista de Proyectos Culminados</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table border-top-0 table-bordered text-nowrap border-bottom basic-datatable-t">
                                <thead>
                                    <tr>
                                        <th>Asignado por</th>
                                        <th>Categoría</th>
                                        <th>Nombre Proyecto</th>
                                        <th>Cliente</th>
                                        <th>Puntos</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Culminación</th>
                                        <th>¿Trjs. Culm.?</th>
                                        <th>Acciones</th>
                                        <th>Visto<br>Bueno</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyectos_aprobados as $proyecto)
                                        <tr>
                                            <td>{{ $proyecto->empleado }}</td>
                                            <td>{{ $proyecto->categoria }}</td>
                                            <td>{{ $proyecto->nombre }}</td>
                                            <td>{{ $proyecto->cliente }}</td>
                                            <td>{{ $proyecto->puntos }}</td>
                                            <td>{{ $proyecto->fecha_inicio }}</td>
                                            <td>{{ $proyecto->fecha_culminacion }}</td>
                                            <td>{{ $proyecto->fecha_culminacion }}</td>
                                            <td>
                                                <a class="d-flex btn_completar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-list"></i>&nbsp;Gestionar
                                                    Estatus</a>
                                                <a class="d-flex btn_board" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-check"></i>&nbsp;Asignaciones</a>
                                                <a class="d-flex btn_avances" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i
                                                        class="fa fa-pencil-alt"></i>&nbsp;Editar</a>
                                                <a class="d-flex btn_avances" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-file"></i>&nbsp;Gestionar
                                                    Acta</a>
                                                <a class="d-flex btn_eliminar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
                                            </td>
                                            <td class="text-center">
                                                <input data-id="{{ $proyecto->id }}" class="visto_bueno_check"
                                                    @if ($proyecto->visto_bueno == 1) { checked } @endif type="checkbox">
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
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/proyectos/proyectos.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn_board', function() {
                let id = $(this).data('id');

                window.open("{{route('tasks.index').'/?project='}}" + id, '_blank');
            });
        });
    </script>
@endsection
