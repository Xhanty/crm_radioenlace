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
                            <button class="btn btn-primary" data-bs-target="#modalAdd" data-bs-toggle="modal"
                                data-bs-effect="effect-scale">Crear Proyecto</button>
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
                                        <th>Acciones</th>
                                        @if (auth()->user()->hasPermissionTo('visto_bueno_proyectos'))
                                            <th>Visto<br>Bueno</th>
                                        @endif
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
                                            <td>
                                                <a class="d-flex btn_completar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-list"></i>&nbsp;Gestionar
                                                    Estatus</a>
                                                <a class="d-flex btn_board" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i
                                                        class="fa fa-check"></i>&nbsp;Asignaciones</a>
                                                <a class="d-flex btn_editar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i
                                                        class="fa fa-pencil-alt"></i>&nbsp;Editar</a>
                                                @if (auth()->user()->hasPermissionTo('gestion_actas_proyectos'))
                                                    <a class="d-flex btn_avances" data-id="{{ $proyecto->id }}"
                                                        href="javascript:void(0);"><i class="fa fa-file"></i>&nbsp;Gestionar
                                                        Acta</a>
                                                @endif
                                                <a class="d-flex btn_eliminar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
                                                @if (auth()->user()->hasPermissionTo('firma_cliente_proyectos'))
                                                    <a class="d-flex btn_avances" data-id="{{ $proyecto->id }}"
                                                        href="javascript:void(0);"><i class="fa fa-user"></i>&nbsp;Firma
                                                        Cliente</a>
                                                @endif
                                            </td>
                                            @if (auth()->user()->hasPermissionTo('visto_bueno_proyectos'))
                                                <td class="text-center">
                                                    <input data-id="{{ $proyecto->id }}" class="visto_bueno_check"
                                                        @if ($proyecto->visto_bueno == 1) { checked } @endif
                                                        type="checkbox">
                                                </td>
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
                                        <th>Acciones</th>
                                        @if (auth()->user()->hasPermissionTo('visto_bueno_proyectos'))
                                            <th>Visto<br>Bueno</th>
                                        @endif
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
                                            <td>
                                                <a class="d-flex btn_completar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-list"></i>&nbsp;Gestionar
                                                    Estatus</a>
                                                <a class="d-flex btn_board" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i
                                                        class="fa fa-check"></i>&nbsp;Asignaciones</a>
                                                <a class="d-flex btn_editar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i
                                                        class="fa fa-pencil-alt"></i>&nbsp;Editar</a>
                                                @if (auth()->user()->hasPermissionTo('gestion_actas_proyectos'))
                                                    <a class="d-flex btn_avances" data-id="{{ $proyecto->id }}"
                                                        href="javascript:void(0);"><i class="fa fa-file"></i>&nbsp;Gestionar
                                                        Acta</a>
                                                @endif
                                                <a class="d-flex btn_eliminar" data-id="{{ $proyecto->id }}"
                                                    href="javascript:void(0);"><i class="fa fa-trash"></i>&nbsp;Eliminar</a>
                                            </td>
                                            @if (auth()->user()->hasPermissionTo('visto_bueno_proyectos'))
                                                <td class="text-center">
                                                    <input data-id="{{ $proyecto->id }}" class="visto_bueno_check"
                                                        @if ($proyecto->visto_bueno == 1) { checked } @endif
                                                        type="checkbox">
                                                </td>
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
        <!-- End Row -->

        <!-- Modal Add -->
        <div class="modal  fade" id="modalAdd">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Registro de Proyecto</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="categoria_add">Categoría proyecto</label>
                                <select id="categoria_add" class="form-select">
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="cliente_add">Cliente</label>
                                <select id="cliente_add" class="form-select">
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="nombre_add">Nombre del proyecto</label>
                                <input type="text" id="nombre_add" class="form-control"
                                    placeholder="Nombre del proyecto">
                            </div>
                            <div class="col-lg">
                                <label for="facturacion_add">¿Requiere Facturación?</label>
                                <select id="facturacion_add" class="form-select">
                                    <option value="">No</option>
                                    <option value="">Sí</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="puntos_add">Puntos</label>
                                <input type="text" id="puntos_add" class="form-control" placeholder="Puntos">
                            </div>
                            <div class="col-lg">
                                <label for="puntos_mensuales_add">Puntos Mensuales</label>
                                <input type="text" id="puntos_mensuales_add" class="form-control"
                                    placeholder="Puntos Mensuales">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="porcentaje_tecnico_add">Porcentaje Técnico</label>
                                <input type="text" id="porcentaje_tecnico_add" class="form-control"
                                    placeholder="Porcentaje Técnico">
                            </div>
                            <div class="col-lg">
                                <label for="porcentaje_participante_add">Porcentaje Participante</label>
                                <input type="text" id="porcentaje_participante_add" class="form-control"
                                    placeholder="Porcentaje Participante">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="fecha_inicio_add">Fecha Inicio</label>
                                <input type="date" id="fecha_inicio_add" class="form-control">
                            </div>
                            <div class="col-lg">
                                <label for="fecha_culminacion_add">Fecha Culminación</label>
                                <input type="date" id="fecha_culminacion_add" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="descripcion_add">Descripción</label>
                                <textarea class="form-control" placeholder="Descripción" rows="3" id="descripcion_add"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnGuardarProyecto" type="button">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal  fade" id="modalEdit">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Modificar Proyecto</h6><button aria-label="Close" class="btn-close"
                            data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" readonly disabled id="id_proyect_edit">
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="categoria_edit">Categoría proyecto</label>
                                <select id="categoria_edit" class="form-select">
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg">
                                <label for="cliente_edit">Cliente</label>
                                <select id="cliente_edit" class="form-select">
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->razon_social }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="nombre_edit">Nombre del proyecto</label>
                                <input type="text" id="nombre_edit" class="form-control"
                                    placeholder="Nombre del proyecto">
                            </div>
                            <div class="col-lg">
                                <label for="facturacion_edit">¿Requiere Facturación?</label>
                                <select id="facturacion_edit" class="form-select">
                                    <option value="">No</option>
                                    <option value="">Sí</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="puntos_edit">Puntos</label>
                                <input type="text" id="puntos_edit" class="form-control" placeholder="Puntos">
                            </div>
                            <div class="col-lg">
                                <label for="puntos_mensuales_edit">Puntos Mensuales</label>
                                <input type="text" id="puntos_mensuales_edit" class="form-control"
                                    placeholder="Puntos Mensuales">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="porcentaje_tecnico_edit">Porcentaje Técnico</label>
                                <input type="text" id="porcentaje_tecnico_edit" class="form-control"
                                    placeholder="Porcentaje Técnico">
                            </div>
                            <div class="col-lg">
                                <label for="porcentaje_participante_edit">Porcentaje Participante</label>
                                <input type="text" id="porcentaje_participante_edit" class="form-control"
                                    placeholder="Porcentaje Participante">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="fecha_inicio_edit">Fecha Inicio</label>
                                <input type="date" id="fecha_inicio_edit" class="form-control">
                            </div>
                            <div class="col-lg">
                                <label for="fecha_culminacion_edit">Fecha Culminación</label>
                                <input type="date" id="fecha_culminacion_edit" class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-lg">
                                <label for="descripcion_edit">Descripción</label>
                                <textarea class="form-control" placeholder="Descripción" rows="3" id="descripcion_edit"
                                    style="height: 90px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="btnModificarProyecto"
                            type="button">Modificar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/app/proyectos/proyectos.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn_board', function() {
                let id = $(this).data('id');

                window.open("{{ route('tasks.index') . '/?project=' }}" + id, '_blank');
            });
        });
    </script>
@endsection
